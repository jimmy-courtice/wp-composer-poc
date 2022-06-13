# Composer-based WordPress POC

The purpose of this project is to prove out the application of a WordPress Version of VMLY&R's
Drupal KIT and use that as a blueprint for WordPress projects moving forward.

VMLY&R's Drupal KIT was borne out of a desire to increase efficiencies, standardize our local development
efforts and improve overall code quality via the use of a standard set of tools and processes.
To that end, this project takes some of the core functionality from Drupal KIT and repurposes it for
WordPress Applications.

To begin with, this project uses Docksal, a docker-based local development 
environment that allows developers to create their own cross-platform custom commands that can do 
everything from initializing complete development environments in a single step to automating the 
packaging and deployment of assets to remote servers and environments. In addition to the added 
functionality gained via the use of Docksal, standardizing local development environments leads to enormous
gains in efficiencies. By dramatically reducing the amount of time and effort it takes to
onboard and spin up stable, working local environments developers are able to get right to work
developing.

On top of that, by leveraging Docksal extendability, we've been able to build out a set of code linting
tools that test and validate a defined set of coding standards. We test and lint everything from the php
source code, to the javascript, to the css and sass written in the project. This linting takes place at 
multiple points in the development process including prior to commits as well as via the front end watch
and build commands.

Finally, this project also leverages Github Actions to manage CI/CD and deployments to remote environments.
Github Actions make it easy for teams to automate their CI/CD workflows by providing a simple, straight-forward
framework for building and deploying code directly from GitHub. Gone are the days of needing another server or provider
to manage automated testing and deployments. Now we do it directly in the repo and GitHub executes the commands
when we tell it to.

* [About KIT](#about-kit)
* [Getting Started](#installation)
* [Post-installation and provider-related configuration](#post-installation-and-provider-related-configuration)
* [Notes & Suggestions](#notes-and-suggestions)
* [Theme Development](#theme-development)


## About KIT

Via a suite of Docksal commands the distribution provides support
for the following:
* [Composer project scaffolding](#composer-project-scaffolding)
* [Docksal command suite](#docksal-command-suite)
* [Using Docksal for CI and build processes](#docksal-+-ci-and-build-processes)

### Composer project scaffolding
Composer is a tool for dependency management in PHP. It allows you to declare the libraries
your project depends on, and it will manage (install/update) them for you. 

This project uses Composer to manage the various libraries that it depends on. In addition, it
enforces structure by adding it's own scaffolding, which runs after
the default scaffolding on composer install and update.

The idea here is to separate the core WordPress functionality from any custom development work.
Essentially, the only directories that we end up caring about are the ones which contain custom code. That is
to say, directories with custom themes and plugins as well as those they facilitate build scripts
and local development.

### Docksal command suite
The project uses [Docksal](https://docksal.io/) for local-environment
development and project-building. The following is a list of Docksal
commands that come included in the project:
- `init` – Typically used when building or rebuilding the project
  and its dependencies. The command will start docksal, download
  dependencies, make sure that the project's relevant directories
  and databases exits, build front-end artifacts, and import databases
  from another environment. The command takes an optional parameter
  `builder`, which is explained in detail below under the
  "Docksal + CI and build processes" section.
- `init-deps` – Used when project dependencies need to be redownloaded
  and installed. Currently consists of Composer and NPM.
- `init-services` – Used when project-based command and tool dependencies
  need to be redownloaded and installed. Currently consists of validating
  that nvm, npm, and node are available in the container.

### Docksal + CI and build processes

Docksal and KIT's commands can be used for running build processes. The
command `init` can toggle "CI mode" by running appending the
`ci` command: `fin init ci`. This is best used when
docksal is used to create the build files to be released. By default,
the builder runs composer in --no-dev mode, and auto-removes
build-related files among other things.

## Installation

Getting a running site takes only a few steps for a project.

1. [Install Docksal](https://docksal.io/installation) if it's not already installed.
2. Install the project.
    1. Download or clone this repo into your local environment. *Note: try not to use hyphenated project names if possible, docksal currently has weird issues with projects with hyphens.*
       ```
       git clone [GIT_URL] [FOLDER_NAME_HERE]"
       ```
    2. Change into the directory.
        ```
        cd [FOLDER_NAME_HERE]
        ```
    3. If this directory was not already a git project, initialize the
       new repository
        ```
        git init
        ```
    4. If this project has a remote repository, add the remote origin
        ```
        git remote add origin [REMOTE_REPOSITORY_URL_HERE]
        ```

3. Run `fin start` in the project to create the Docksal project.
4. Run `fin init`. You only need to do this once. After the project is intialized you'll use `fin start` or `fin stop` respectively.
5. Once initialization is complete, you'll be given a local url for the site as well as one for the admin panel.
6. To start up or spin down your local environment you can run `fin start` or `fin stop` respectively.

## Post-installation and provider-related configuration

### Github Actions

#### Default actions provided
##### Build & Deploy
This action watches the main branch, and when code is merged into it, automatically builds and deploys the code to the Production environment.
This action uses the default "Build package" and "Deploy production package" action steps.

## Theme Development

All of your custom development should occur in the **docroot/custom/** directory. 

If you're building out a new theme, you should do it here: **docroot/custom/yourtheme**
This directory is meant to only contain the files WP needs to render the site - e.g. css, javascript, images, template files.
These files are

Gulp is used to process the files in _source_ and writes the corresponding output to the matching theme directory under _docroot_. The default gulp file (source/gulpfile.js) is set up with a set of basic tasks needed by most themes. It is also set up to run those tasks in all of the directories under source/themes/custom. This allows the developer to have multiple themes (e.g. a base theme and child themes) under development and use a single command to build them all.

The following functionality is provided by the default gulp file:

- Sass - Processes all of the scss files under _styles_ in each theme directory and generates source maps. The output is places in _docroot/themes/custom/yourtheme/css_.
- Javascript - Copies and generates source maps for all js files under _scripts_ in each theme directory. The output is placed in _docroot/custom/yourtheme/js_.
- Images - Minifies all images under _images_ and places the output in _docroot/custom/yourtheme/images_.
- Fonts - Copies all the files under _fonts_ to _docroot/custom/yourtheme/fonts_.
- Testing - Linting of sass and javascript files as configured in _.sass-lint.yml_ and _.eslintrc_.

Tasks provided by the default gulp file are:

- default - Builds the Sass, Javascript, Images, Fonts, and Icons as described above.
- test - Runs the sass and javascript linters.
- watch - Builds everything included in the default task as file change in the _source_ directory structure.