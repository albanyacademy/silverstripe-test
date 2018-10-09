<header id="page-header" class="center-xs" role="banner">
    <div class="container">
        <% if $SearchForm == "fuck" %>
            <span class="search-dropdown-icon">L</span>
            <div class="search-bar">
                $SearchForm
            </div>
        <% end_if %>
            <div class="page-hero">
                <h1 class="hero-title responsive-title"><% if $HeaderTitle %>$HeaderTitle<% else %>$Title<% end_if %></h1>
                <% if $Subtitle %><p class="hero-subtitle">$Subtitle</p><% end_if %>
            </div>
    </div>
</header>
