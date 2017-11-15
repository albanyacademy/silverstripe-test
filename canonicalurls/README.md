Canonical URLs
===============


**Author:** Cameron Lindsay

Based off the work of:
**Author:** Sam Minnée

**Author:** Stig Lindqvist

**Author:** Russ Michell


This module provides a system for users to configure canonical urls for files, like PDFs and PNGs, or SVGs, or perhaps even JPEGs, for whatever reason.
This is apparently an SEO tactic, wherein you create a page with all of the content from the PDF on it, and then set a canonical link in the request header for the corresponding PDF.
I have no idea if that actually has any meaningful impact on SEO, but it came in as a request and I thought this module would be a good way to do it.
Thanks to the folks who did the RedirectedURLS module, as that proved a good base for my modifications.



//TODO
Installation
------------
Either:
1. Download or git clone the 'redirectedurls' directory to your webroot, or;
2. Using composer run the following in the command line:

  composer require silverstripe/redirectedurls dev-master

3. Run dev/build (http://www.mysite.com/dev/build?flush=all)

Usage
-----
 1. Click 'Redirects' in the main menu of the CMS.
 2. Click 'Add Redirected URL' to create a mapping of an old URL to a new URL on your SilverStripe website.
 3. Enter a 'From Base' which is the URL from your old website (not including the domain name). For example, "/about-us.html".
 4. Alternatively, depending on your old websites URL structure you can redirect based on a query string using the combination of 'From Base' and 'From Querystring' fields. For exmaple, "index.html" as the base and "page=about-us" as the query string.
 5. As a further alternative, you can include a trailing '/*' for a wildcard match to any file with the same stem. For example, "/about/*".
 6. Complete the 'To' field which is the URL you wish to redirect traffic to if any traffic from. For example, "/about-us".
 7. Alternatively you can terminate the 'To' field with '/*' to redirect to the specific file requested by the user. For example, "/new-about/*". Note that if this specific file is not in the target directory tree, the 404 error will be handled by the target site.
 8. Create a new Redirection for each URL mapping you need to redirect.

For example, to redirect "/about-us/index.html?item=1" to "/about-us/item/1", set:

	From Base:  /about-us/index.html
	From Querystring:  item=1
	To:  /about-us/item/1

Importing
---------
 1. Create a CSV file with the columns headings 'FromBase', 'FromQuerystring' and 'To' and enter your URL mappings.
 2. Click 'Redirects' in the main menu of the CMS.
 3. In the 'Import' section click 'Choose file', select your CSV file and then click 'Import from CSV'.
 4. Optionally select the 'Replace data' option if you want to replace the RedirectedURL database table contents with the imported data.

CSV Importer, example file format:

	FromBase, FromQuerystring, To
	/about-us/index.html, item=1, /about/item/1
	/example/no-querystring.html, ,/example/no-querystring/
	/example/two-queryparams.html, foo=1&bar=2, /example/foo/1/bar/2
	/about/*, ,/about-us
