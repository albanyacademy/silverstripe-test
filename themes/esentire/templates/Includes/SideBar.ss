<h3 class="sidebar-title">Categories</h3>
<ul class="sidebar">
	<% loop $getCategories %>
        <li>
            <a href="$Link" class="sidebar-link $LinkingMode" title="$Title">$Title</a>
            <% if $Linkingmode == "section" || $LinkingMode == "current" %>
                <ul class="sidebar sidebar-sub-list">
                    <% loop $Children %>
                        <li class="sidebar-child">
                            <a class="sidebar-link sidebar-child-link $Linkingmode" href="$Link" title="$Title">$Title</a>
                        </li>
                    <% end_loop %>
                </ul>
            <% end_if %>
        </li>
	<% end_loop %>
</ul>