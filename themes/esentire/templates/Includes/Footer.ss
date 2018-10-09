<% if $CTA %>
	<div class="primary-cta center-xs">
		<div class="primary-cta--title h3">CTA Title</div>
		<div class="primary-cta--button btn btn-primary">Click</div>
	</div>
<% end_if %>
<footer class="footer" role="contentinfo">
	<% if $FooterNav %>
		<nav class="container">
			<div class="row footer--row">
				<% loop $Menu(1) %>
					<ul class="footer-list">
						<li><h4><a href="$Link" title="$Title">$Title</a></h4>
							<% if $Children %>
								<ul class="footer-list footer-list--sub">
									<% loop $Children %>
										<li><a href="$Link" title="$Title">$Title</a></li>
									<% end_loop %>
								</ul>
							<% end_if %>
						</li>
					</ul>

				<% end_loop %>
			</div>
		</nav>
	<% end_if %>
	<div class="footer-bottom">
		<div class="container">
            <p class="copyright">
                © $Now.Year eSentire. All rights reserved. &nbsp;
                <a href="/site-map/">Site Map</a>
                &nbsp; | &nbsp;
                <a href="/terms-and-conditions/">Terms and Conditions</a>
                &nbsp; | &nbsp;
                <a href="/privacy-policy/">Privacy Policy</a>
                &nbsp; | &nbsp; <a href="/accessibility/">Accessibility</a>
            </p>
		</div>
	</div>
</footer>