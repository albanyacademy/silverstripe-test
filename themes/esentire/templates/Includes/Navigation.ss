<nav class="page-nav col-xs row middle-xs no-margin" id="page-nav">
    <div class="page-nav-brand">
        <a class="page-nav-brand-wrapper" href="$BaseHref" rel="home">
            <img class="page-nav-brand-logo" src="$ThemeDir/images/esentire-logo.svg" alt="eSentire">
        </a>
    </div>
    <% if $NotContracts %>
            <ul class="page-nav-primary-list row no-margin">
                <% loop $Menu(1) %>
                    <% if $Pos = 1 %>
                    <% else %>
                        <li class="page-nav-list-item<% if $Children %> page-nav-list-item--has-dropdown<% end_if %>">
                            <a class="page-nav-list-link page-nav-list-link-mode--$LinkingMode<% if $Children %> page-nav-list-link--has-dropdown<% end_if %>" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                            <% if $Children %>
                                <ul class="page-nav-list-item--dropdown">
                                    <% loop $Children %>
                                        <li class="page-nav-list-item--dropdown-item"><a class="page-nav-list-link--dropdown-link page-nav-list-link--dropdown-link-mode--$LinkingMode" href="$Link">$Title.XML</a></li>
                                    <% end_loop %>
                                </ul>
                            <% end_if %>
                    </li>
                    <% end_if %>
                <% end_loop %>
            </ul>
        <% end_if %>
        <div class="page-nav-ctas row no-margin">
            <a class="btn btn-primary">Contact Us</a>
        </div>
</nav>
