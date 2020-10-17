<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<div id="body">
        <div class="box arrow-bottom" id="notification">
          <span style="padding-right:20px">Live chat with Ava</span>
          <span class="cross"><i class="material-icons" style="font-size:20px;cursor:pointer">cancel</i></span>
        </div>

        <div id="chat-circle" class="btn btn-raised">  
            <div id="chat-overlay"></div>
            <i class="material-icons">chat</i>
        </div>

        <div class="chat-box">
            <div class="chat-box-header">
            <div class="type"></div>
                Live Chat
                <span class="chat-box-toggle"><i class="material-icons" style="line-height:1.2;">cancel</i></span>
            </div>
            <div class="chat-box-body">
                <div class="chat-box-overlay">
                </div>
                <div class="chat-logs">

                </div>
            </div>
            <div class="chat-input">
                <form>
                    <input type="text" id="chat-input" placeholder="Send a message..." />
                    <button type="submit" class="chat-submit" id="chat-submit"><i
                            class="material-icons">send</i></button>
                </form>
            </div>
        </div>

    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

<script type="text/javascript">

  $(".cross").click(function () {
    $("#notification").remove();
  })

  var cimg = "<div class=\"cm-cimg\">" + "<\/div>";
  var uimg = "<div class=\"cm-uimg\">" + "<\/div>";
  var INDEX = 0;
  generate_message(cimg, "Ava", "Hello, my name is Ava, your virtual assistant. May I know your name?", 'user');
 
  var codeBlock = '<div class="content">' + '<input type="text" class="iname" id="iname" placeholder="Your Name">' + '<br>' + '<input type="submit" value="Submit" class="isubmit" id="isubmit">' +'</div>';
  
  generate_message(cimg, "Ava", codeBlock, 'user');

  var dm = '';
  var iname = '';
  var iemail = '';
  var firstWord = '';

  $("#isubmit").click(function (e) {
    dm = $("#iname").val();
    iemail = $("#iemail").val();
    firstWord = dm.replace(/ .*/,'');
    iname = firstWord.charAt(0).toUpperCase() + firstWord.slice(1);
    if(iname != '') {
      generate_message(cimg, "Ava", "Hello " + iname + ", How may I help you?", 'user');
    
      $.post('users.php',{postiname:iname,postiemail:iemail});
    }
  })
    
  $("#chat-submit").click(function (e) {
    e.preventDefault();
    var msg = $("#chat-input").val();
    
    if (msg.trim() == '') {
      return false;
    }

    if(iname == ''){
      iname = "You";
    }

    generate_message(uimg, iname, msg, 'self');
    $(".type").text("Typing").fadeIn(0);

    var url = 'request.php';

    $.post(url,{postmsg:msg},            
    function(data) {
      $(".type").fadeOut(0);
      generate_message(cimg, "Ava", data, 'user');
    });
    
  })

  function generate_message(img, sender, msg, type) {
    INDEX++;
    var fmsg = "<div class=\"cm-fmsg\">" + msg + "<\/div>";
    function addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
    var d = new Date();
    var send = "<span class=\"cm-send\">" + sender + "<\/span>" ;
    var time = "<span class=\"cm-time\">" + addZero(d.getHours()) + ":" + addZero(d.getMinutes()) + "<\/span>" + "<br>" ;
    var str = "";
    str += "<div id='cm-msg-" + INDEX + "' class=\"chat-msg " + type + "\">";
    str += "          <div class=\"cm-msg-text\">";
    str += img + send + time + fmsg;
    str += "          <\/div>";
    str += "        <\/div>";
    $(".chat-logs").append(str);
    $("#cm-msg-" + INDEX).hide().fadeIn(300);
    if (type == 'self') {
      $("#chat-input").val('');
    }
    $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight }, 1000);
  }

  $("#chat-circle").click(function () {
    $("#notification").remove();
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
  })

  $(".chat-box-toggle").click(function () {
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
  })
  
</script>