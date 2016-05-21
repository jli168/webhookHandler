<?php
$str = "https://api.github.com/repos/njuljsong/testhook/contents/{+path}";
$file = "text2.txt";

//want to replace {+path} with filename

$file = str_replace("{+path}", $file, $str);
var_dump($file);

/* sample data from content api
get data from https://api.github.com/repos/njuljsong/testhook/contents/temp/temp.txt: {
  "name": "temp.txt",
  "path": "temp/temp.txt",
  "sha": "ec24f2557501921a6068471fd32ca224689db958",
  "size": 15,
  "url": "https://api.github.com/repos/njuljsong/testhook/contents/temp/temp.txt?ref=master",
  "html_url": "https://github.com/njuljsong/testhook/blob/master/temp/temp.txt",
  "git_url": "https://api.github.com/repos/njuljsong/testhook/git/blobs/ec24f2557501921a6068471fd32ca224689db958",
  "download_url": "https://raw.githubusercontent.com/njuljsong/testhook/master/temp/temp.txt",
  "type": "file",
  "content": "aW4gdGVtcAphZGQgMiAK\n",
  "encoding": "base64",
  "_links": {
    "self": "https://api.github.com/repos/njuljsong/testhook/contents/temp/temp.txt?ref=master",
    "git": "https://api.github.com/repos/njuljsong/testhook/git/blobs/ec24f2557501921a6068471fd32ca224689db958",
    "html": "https://github.com/njuljsong/testhook/blob/master/temp/temp.txt"
  }
}
*/
?>

