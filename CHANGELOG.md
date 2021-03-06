# Changelog

All notable changes to `laravel-verify-email` will be documented in this file

## 1.0.0 - 2021-03-12

- Added Documenation
- Edited `newEmail` in `MustVerifyNewEmail` to protected function
- Edited `sendEmailVerificationMail` in `MustVerifyNewEmail` to protected function

## 0.2.3 - 2021-03-12

- Added description in config
- Added `expire` for verification link in config
- Added new function `syncEmail` in Trait `MustVerifyNewEmail`
- Added configuration options in Trait `MustVerifyNewEmail`
- Added translation string in Mail `VerifyEmail`
- Added translation strings in emails `verifyEmail`
- Added command comment to suggest using laravel/breeze
- Edited markdown view to `emails.auth.verify-email` in Mail `VerifyEmail`
- Edited emails name to `verify-email`
- Fixed wrong class name of Mailable `VerifyEmail`
- Fixes security issue in function `newEmail` in `MustVerifyNewEmail`
- Fixed wrong class name of migration `CreatePendingUserEmails`
- Fixed wrong namespace of Model `PendingUserEmails`
- Fixed wrong usage of Mailable class `VerifyEmail`

## 0.1.0 - 2021-03-11

- Adding all files as stubs
- Adding installation command `verify-email:install`
