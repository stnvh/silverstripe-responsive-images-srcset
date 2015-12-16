<img src="{$DefaultImage.URL}"
	srcset="<% loop Sizes %>{$Image.URL} {$Query}<% if not Last %>, <% end_if %><%end_loop %>"
	sizes="100vw"
	alt="{$Title}" />
