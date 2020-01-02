<button id="link-button">Link Account</button>
<script 
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script 
src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<script type="text/javascript">
(function($) {
  var handler = Plaid.create({
    clientName: 'Plaid Quickstart',
    // Optional, specify an array of ISO-3166-1 alpha-2 country
    // codes to initialize Link; European countries will have GDPR
    // consent panel
    countryCodes: ['US'],
    selectAccount: true,
    env: 'sandbox',
    // Replace with your public_key from the Dashboard
    key: '8dff4470cf306ba8d41f50f0b0d7af',
    product: ['transactions'],
    // Optional, use webhooks to get transaction and error updates
    webhook: 'https://requestb.in',
    // Optional, specify a language to localize Link
    language: 'en',
    // Optional, specify userLegalName and userEmailAddress to
    // enable all Auth features
    userLegalName: 'John Appleseed',
    userEmailAddress: 'jappleseed@yourapp.com',
    onLoad: function() {
      // Optional, called when Link loads
    },
    onSuccess: function(public_token, metadata) {
      // Send the public_token to your app server.
      // The metadata object contains info about the institution the
      // user selected and the account ID or IDs, if the
      // Select Account view is enabled.
      $.post('process.php', {
        pt:public_token,md:metadata,id:1234
      });
    },
    onExit: function(err, metadata) {
      // The user exited the Link flow.
      if (err != null) {
        // The user encountered a Plaid API error prior to exiting.
      }
      // metadata contains information about the institution
      // that the user selected and the most recent API request IDs.
      // Storing this information can be helpful for support.
    },
    onEvent: function(eventName, metadata) {
      // Optionally capture Link flow events, streamed through
      // this callback as your users connect an Item to Plaid.
      // For example:
      // eventName = "TRANSITION_VIEW"
      // metadata  = {
      //   link_session_id: "123-abc",
      //   mfa_type:        "questions",
      //   timestamp:       "2017-09-14T14:42:19.350Z",
      //   view_name:       "MFA",
      // }
    }
  });

  $('#link-button').on('click', function(e) {
    handler.open();
  });
})(jQuery);
</script>