# Checklist Viewer


ChecklistViewer is a simple wrapper around Markdown files which will be rendered as checklists. You can versioncontrol your markdown files, print them, etc. The wrapper adds simple GUI around them to check of single todos. Also you can export them to [Trello](https://trello.com).

Think of those Markdown files as tempaltes for recurring checklists, which you can version control and collaborate on.


## Markdown format

You can use all common markdown features.

Die first heading in a file will be the name of the checklist, all second level headings are individual checklist items. The content beneath a heading is the (optional) item description.

Example:

```
# Checklist

## First item

Description of __the__ first item

## Second item

- you can also
- list inside
- the descritopn

## Third item

## Fourth item

```

Save your markdown files in an empty folder, and organize them in any folder structure you want.


## Installation

### Requirements

- [NPM](https://www.npmjs.com/get-npm)
- [Bower](https://bower.io/)
- [Composer](https://getcomposer.org/)

Run `$ npm install && bower install && composer install` to fetch all dependencies, then build CSS and JS assets with `$ grunt`.

Copy the `.env.example` to `.env` and edit the values. You can define the base directory in wich the markdown files are stored (in this you can init an empty git repository to track your markdown files).

