# Changelog

All notable changes to this project will be documented in this file.

###Types of changes
- Added for new features.
- Changed for changes in existing functionality.
- Deprecated for soon-to-be removed features.
- Removed for now removed features.
- Fixed for any bug fixes.
- Security in case of vulnerabilities.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

## [1.0.0] - 2022-09-20

### Added
- Height and width parameter can be cleared by calling `height()` or `width()` with no argument.
  This also applies to `size()` - both `width` and `height` arguments are optional and the 
  relevant Glide parameter is removed as appropriate
- Filters can be cleared by calling `filt()` with no arguments
- Flip can be cleared by calling `flip()` with no arguments
- Orientation can be cleared by calling `orientation()` with no arguments
- Most watermark parameters can be cleared:
  - `mark()`
  - `markWidth()`
  - `markHeight()`
  - `markX()`
  - `markY()`
  - `markPad()`
- Glide FluentUrlBuilder instances can now be cloned using the `FluentUrlBuilder::clone()`
- Avif support via `FluentUrlBuilder::avif()`
- Added fill-max format for "fit" parameter

### Fixed
- Setting an encoding option without an explicit quality value clears the quality parameter

## [0.3.0] - 2022-03-14

###Changed
- Upgrading to league/glide 2.0.0