$("#sms_chat").on("submit", "#chat_form", function() {
  var $me = $(this);
  $.post($me.attr("action"), $me.serialize(), function(data) {
    if (data.done) {
      $me.get(0).reset();
    } else {
      $("#error-summary").html(data.error);
    }
  });
  return false;
});

$(document).on("pjax:complete", function() {
  searchMessage();
});

function smsPoll() {
  $.pjax.reload({
    container: "#chat-list",
    url: $("#chat_form").data("url") + "&poll=1",
    push: false,
    replace: false,
    timeout: 120000
  });
}

function smsScroll() {
  var $list = $("#sms_chat_list_scroll");
  $list
    .stop()
    .animate({ scrollTop: $list.prop("scrollHeight") }, "500", "swing");
}

function searchMessage() {
  setTimeout(function() {
    smsScroll();
    smsPoll();
  }, 0);
}

searchMessage();
