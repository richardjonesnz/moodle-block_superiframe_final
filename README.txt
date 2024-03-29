The following steps should get you up and running with
this block template code.

* DO NOT PANIC!

* Unzip the archive and read this file

* Rename thesuperiframe/ folder to the name of your module (eg "widget").
The module folder MUST be lower case. You should check the Moodle Plugins
Database at https://moodle.org/plugins to make sure that
your name is not already used by an other block. Registering the plugin
name @ http://moodle.org/plugins will secure it for you.

* Edit all the files in this directory and its subdirectories and change
all the instances of the string "superiframe" to your module name
(eg "widget"). If you are using Linux, you can use the following command
$ find . -type f -exec sed -i 's/superiframe/widget/g' {} \;

* Rename the file lang/en/superiframe.php to lang/en/widget.php
where "widget" is the name of your module. Also rename block_superiframe.php
in the main directory to block_widget.php

* Place the widget folder into the /block folder of the moodle
directory.

* This template assumes that the block is using a textual content type by default. If you want your block to display a list of items (using $this->content->items and $this->content->icons instead of $this->content->text), change the derived class of the block, from extends block_base to extends block_list. For more information: https://docs.moodle.org/dev/Blocks#Additional_Content_Types.

* Go to Settings > Site Administration > Development > XMLDB editor
and modify the module's tables.

* Modify version.php and set the initial version of you module.

* Visit Settings > Site Administration > Notifications, you should find
the module's tables successfully created

* Go to Site Administration > Plugins > Blocks > Manage blocks
and you should find that thissuperiframe has been added to the list of
installed modules.

* You may now proceed to run your own code in an attempt to develop
your module. You will probably want to modify block_newmodule.php
and edit_form.php as a first step. Check db/access.php to add
capabilities.

We encourage you to share your code and experience - visit http://moodle.org

Good luck!
