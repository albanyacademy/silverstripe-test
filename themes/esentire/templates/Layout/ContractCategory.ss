<% if $Content %>
    <div class="main--content">
        $Content
    </div>
<% end_if %>
<% if $Children %>
    <div class="row">
        <% loop $Children %>
            <div class="col-xs-12 col-sm-6">
                <div class="child-card card-white">
                    <div class="child-card-title">$Title</div>
                    <div class="child-card-description">$Blurb</div>
                    <a href="$Link" class="child-card-link">Learn More</a>
                </div>
            </div>
        <% end_loop %>
    </div>

<% end_if %>