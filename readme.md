
# RIVO Wordpress Telegram Forms Sender

## README FOR DEVELOPMENT

### PHP Files Autoloading:
<ol>
    <li>By composer</li>
    <li>New php files need to be added at <b>files</b> section in file <b>composer.json</b></li>
    <li>Then in Terminal - <b>composer dumpautoload</b></li>
    <li>Composer default folder <b>vendor</b> renamed to <b>lib</b></li>
</ol>

### Compilation styles & scripts:

<ol>
    <li>By laravel mix</li>
    <li>Configuration file - <b>webpack.mix.js</b></li>
    <li>Source files from <b>/assets/src</b> will be compilated to <b>/assets/dist</b> </li>
    <li>If folder "node_modules" does not exists. Terminal - <b>npm install</b></li>
    <li>Compilation while <b>development</b> - Terminal - <b>npm run watch</b></li>
    <li>Compilation <b>production</b> - Terminal - <b>npm run prod</b></li>
</ol>

