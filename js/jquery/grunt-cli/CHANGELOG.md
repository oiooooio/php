- v1.2.0
  - date: 2016-04-01
  - changes:
    - Use shared grunt-known-options module.
- v1.1.0
  - date: 2016-03-22
  - changes:
    - Update to "nopt": "~3.0.6".
    - nopt is upgraded to ~3.0.6 which has fixed many issues, including passing multiple arguments and dealing with numbers as options.
      Be aware previously --foo bar used to pass the value 'bar' to the option foo. It will now set the option foo to true and run the task bar.
- v1.0.1
  - date: 2016-03-22
  - changes:
    - Revert to "nopt": "~1.0.10" due to issues with the update.
- v1.0.0
  - date: 2016-03-21
  - changes:
    - Update dev deps
    - Update error message when Gruntfile is not found
- v1.0.0-rc1
  - date: 2016-02-11
  - changes:
    - Update findup-sync and other deps
    - remove prefer global warning