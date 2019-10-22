# An elementary php templating class

Parses file at given path with given data from an associated array.

The class is elementary, no setters/getters, no nothing, just the working body.
Inherit and add more features should you need them.

Example usage:
```php
<?php
// Create instance
$tpl = new \SeeKing\tpl\tpl( "path/to/file.html", ["header"=> "Homepage",  "url" => "/" ]);

// add more data if needed
$tpl->data["subtitle"] = "The site homepage";

// change file path if needed
$tpl->filePath = "/path/to/some/other/file.html";

// render the template
echo $tpl->render();

// alternative usage with static call
echo \SeeKing\tpl\tpl::html("path/to/file.html", ["header"=> "Homepage",  "url" => "/" ]);
```

