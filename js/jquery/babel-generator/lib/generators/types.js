"use strict";

exports.__esModule = true;
exports.ArrayPattern = exports.ObjectPattern = exports.RestProperty = exports.SpreadProperty = exports.SpreadElement = undefined;

var _stringify = require("babel-runtime/core-js/json/stringify");

var _stringify2 = _interopRequireDefault(_stringify);

exports.Identifier = Identifier;
exports.RestElement = RestElement;
exports.ObjectExpression = ObjectExpression;
exports.ObjectMethod = ObjectMethod;
exports.ObjectProperty = ObjectProperty;
exports.ArrayExpression = ArrayExpression;
exports.RegExpLiteral = RegExpLiteral;
exports.BooleanLiteral = BooleanLiteral;
exports.NullLiteral = NullLiteral;
exports.NumericLiteral = NumericLiteral;
exports.StringLiteral = StringLiteral;

var _babelTypes = require("babel-types");

var t = _interopRequireWildcard(_babelTypes);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function Identifier(node) {
  if (node.variance) {
    if (node.variance === "plus") {
      this.token("+");
    } else if (node.variance === "minus") {
      this.token("-");
    }
  }

  this.word(node.name);
}

function RestElement(node) {
  this.token("...");
  this.print(node.argument, node);
}

exports.SpreadElement = RestElement;
exports.SpreadProperty = RestElement;
exports.RestProperty = RestElement;
function ObjectExpression(node) {
  var props = node.properties;

  this.token("{");
  this.printInnerComments(node);

  if (props.length) {
    this.space();
    this.printList(props, node, { indent: true, statement: true });
    this.space();
  }

  this.token("}");
}

exports.ObjectPattern = ObjectExpression;
function ObjectMethod(node) {
  this.printJoin(node.decorators, node);
  this._method(node);
}

function ObjectProperty(node) {
  this.printJoin(node.decorators, node);

  if (node.computed) {
    this.token("[");
    this.print(node.key, node);
    this.token("]");
  } else {
    if (t.isAssignmentPattern(node.value) && t.isIdentifier(node.key) && node.key.name === node.value.left.name) {
      this.print(node.value, node);
      return;
    }

    this.print(node.key, node);

    if (node.shorthand && t.isIdentifier(node.key) && t.isIdentifier(node.value) && node.key.name === node.value.name) {
      return;
    }
  }

  this.token(":");
  this.space();
  this.print(node.value, node);
}

function ArrayExpression(node) {
  var elems = node.elements;
  var len = elems.length;

  this.token("[");
  this.printInnerComments(node);

  for (var i = 0; i < elems.length; i++) {
    var elem = elems[i];
    if (elem) {
      if (i > 0) this.space();
      this.print(elem, node);
      if (i < len - 1) this.token(",");
    } else {
      this.token(",");
    }
  }

  this.token("]");
}

exports.ArrayPattern = ArrayExpression;
function RegExpLiteral(node) {
  this.word("/" + node.pattern + "/" + node.flags);
}

function BooleanLiteral(node) {
  this.word(node.value ? "true" : "false");
}

function NullLiteral() {
  this.word("null");
}

function NumericLiteral(node) {
  var raw = this.getPossibleRaw(node);

  this.number(raw == null ? node.value + "" : raw);
}

function StringLiteral(node, parent) {
  var raw = this.getPossibleRaw(node);
  if (raw != null) {
    this.token(raw);
    return;
  }

  var val = (0, _stringify2.default)(node.value);

  val = val.replace(/[\u000A\u000D\u2028\u2029]/g, function (c) {
    return "\\u" + ("0000" + c.charCodeAt(0).toString(16)).slice(-4);
  });

  if (this.format.quotes === "single" && !t.isJSX(parent)) {
    val = val.slice(1, -1);

    val = val.replace(/\\"/g, '"');

    val = val.replace(/'/g, "\\'");

    val = "'" + val + "'";
  }

  return this.token(val);
}