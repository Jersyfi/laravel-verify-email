# Changelog

All notable changes to `laravel-verify-email` will be documented in this file

## 0.2.0 - 2021-03-12

- Added description in config
- Added `expire` for verification link in config
- Added new function `syncEmail` in Trait `MustVerifyNewEmail`
- Added configuration options in Trait `MustVerifyNewEmail`
- Fixed wrong class name of Mailable `VerifyEmail`
- Fixes security issue in function `newEmail` in `MustVerifyNewEmail`

## 0.1.1 - 2021-03-11

- Fixed wrong class name of migration `CreatePendingUserEmails`
- Fixed wrong namespace of Model `PendingUserEmails`
- Fixed wrong usage of Mailable class `VerifyEmail`

## 0.1.0 - 2021-03-11

- Adding all files as stubs
- Adding installation command `verify-email:install`
