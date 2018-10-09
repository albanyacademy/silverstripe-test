<% if $Content %>
    <div class="main--content">
		$Content
    </div>
<% end_if %>
<% if $Assets %>
    <div class="row">
		<% loop $Assets %>
            <div class="col-xs-12 col-sm-6">
                <div class="child-card card-white asset-card row">
                        <img src="http://localhost/NWOBHC/resources/silverstripe/framework/client/images/app_icons/document_92.png">
                    <div class="asset-card-content col">
                        <div class="child-card-title">$Title</div>
                        <div class="child-card-description">$Blurb</div>
                        <div class="child-card-edited">Last Edited $LastEdited.Nice</div>
                        <a href="$Link" class="child-card-link">Download</a>
                    </div>
                </div>
            </div>
		<% end_loop %>
    </div>
<% else_if $Children %>
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