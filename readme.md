# ChecklistViewer


ChecklistViewer is a simple website wrapper around markdown files which will be rendered as checklists. Think of those markdown files as tempaltes for recurring checklists you need to check off. For example project setups or monthly recurring taks with multiple steps.

You store the markdown file in a seperate git repository so you can versioncontrol them and collaborte on them with everyone in your team. The wrapper adds simple interface around the markdown files to check off single todos. Additionally you can print the checklists or export them to your [Trello board](https://trello.com).

## Checklist format

You can use all common markdown features.

The first heading in a file will be the name of the checklist, all second level headings are individual checklist items. The content beneath a heading is the (optional) item description where you can write down additional information regarding the todo item.

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

You need:

- [NPM](https://www.npmjs.com/get-npm)
- [Bower](https://bower.io/)
- [Composer](https://getcomposer.org/)

Clone the repository to your webserver and run `$ npm install && bower install && composer install` to fetch all dependencies, then build CSS and JS assets with `$ grunt`.

Copy the `.env.example` to `.env` and edit the values. You can define the base directory in wich the markdown files are stored (in this you can init an empty git repository to track your markdown files).

If you want to export your checklists to Trello add your [Trello API Key](https://trello.com/app-key) to the `.env` file.

Create an empty direcotry `checklists/` and init a new git repository. In this direcotry add as many markdown files in the above syntax, you can also use folders to stucture them.

Open the `index.php` in your browser! (maybe you need the change the `RewriteBase` in the `.htaccess` file to math your environment)

## Meta

Jonathan Ströbele ([@stroebjo](https://twitter.com/stroebjo)) - [pbi planungsbüro INTERNET GmbH](https://planungsbuero.de/)

Distributed under the MIT license. See ``LICENSE`` for more information.
