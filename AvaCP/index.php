<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<div id="body">
        <div class="box arrow-bottom" id="notification">
          <span class="chat-nf">Live chat with Ava</span>
          <span class="cross"><i class="material-icons" style="font-size:20px;cursor:pointer;color:#ffffff">cancel</i></span>
        </div>

        <div id="chat-circle" class="btn btn-raised">  
            <div id="chat-overlay"></div>
            <i class="material-icons">chat</i>
        </div>

        <div class="chat-box">
            <div class="chat-box-header">
            <div class="type"></div>
                Live Chat
                <span class="chat-box-toggle"><i class="material-icons" style="line-height:1.2;color:#ffffff">cancel</i></span>
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
 
  var codeBlock = '<div class="icontent">' + '<input type="text" class="iname" id="iname" placeholder="Your Name">' + '<br>' + '<input type="submit" value="Submit" class="isubmit" id="isubmit">' +'</div>';
  
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
      if(data == ""){
        $(".type").fadeOut(0);
        generate_message(cimg, "Ava", "Sorry I am not able to understand it, Can you rephrase it and try!!", 'user');
      }
      else {
        $(".type").fadeOut(0);
        generate_message(cimg, "Ava", data, 'user');
      }
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

<style>
    #center-text {
  display: flex;
  flex: 1;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100%;
}
#chat-circle {
  z-index: 1000;
  position: fixed;
  bottom: 30px;
  right: 30px;
  background: #e55125;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  color: white;
  padding: 28px;
  cursor: pointer;
  box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.6),
    0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}

.chat-nf {
    color: #ffffff;
    padding-right:20px;
}

.content {
  margin-top: 5px;
}

.icontent {
  margin-top: 5px;
}

.iname {
  padding: 6px 10px;
  margin-bottom: 8px;
  display: inline-block;
  border: 2px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  width: 100%;
}


.isubmit {
  width: 100%;
  background-color: #4caf50;
  color: white;
  padding: 6px 10px;
  margin-bottom: 5px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.isubmit:hover {
  background-color: #45a049;
}

.box {
  z-index: 1000;
  font-weight: bold;
  bottom: 130px;
  right: 30px;
  width: auto;
  height: auto;
  background-color: #e55125;
  color: #fff;
  padding: 18px;
  position: fixed;
  border-radius: 5px;
  float: left;
  animation: mymove 3s infinite;
}

@keyframes mymove {
  50% {
    box-shadow: 0px 0px 15px grey;
  }
}

.box.arrow-bottom:after {
  content: " ";
  position: absolute;
  right: 25px;
  bottom: -15px;
  border-top: 15px solid #e55125;
  border-right: 15px solid transparent;
  border-left: 15px solid transparent;
  border-bottom: none;
}

.btn#my-btn {
  background: white;
  padding-top: 13px;
  padding-bottom: 12px;
  border-radius: 45px;
  padding-right: 40px;
  padding-left: 40px;
  color: #5865c3;
}
#chat-overlay {
  background: rgba(255, 255, 255, 0.1);
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  display: none;
}

.chat-box {
  z-index: 1000;
  display: none;
  background: #efefef;
  position: fixed;
  right: 30px;
  bottom: 50px;
  width: 350px;
  max-width: 85vw;
  max-height: 100vh;
  border-radius: 5px;
  box-shadow: 0px 5px 35px #ccc;
}
.chat-box-toggle {
  float: right;
  margin-right: 15px;
  cursor: pointer;
}
.chat-box-header {
  font-weight: 500;
  background: #e55125;
  height: 70px;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  color: white;
  text-align: center;
  font-size: 20px;
  padding-top: 17px;
  padding-left: 25px;
}
.chat-box-body {
  position: relative;
  height: 370px;
  height: auto;
  border: 1px solid #ccc;
  overflow: hidden;
}
.chat-box-body:after {
  content: "";
  opacity: 0.1;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  height: 100%;
  position: absolute;
  z-index: -1;
}

#chat-input {
  background: #f4f7f9;
  width: 100%;
  position: relative;
  height: 47px;
  padding-top: 10px;
  padding-right: 50px;
  padding-bottom: 10px;
  padding-left: 15px;
  border: none;
  resize: none;
  outline: none;
  border: 1px solid #ccc;
  color: #888;
  border-top: none;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
  overflow: hidden;
}

#chat-in {
  background: #f4f7f9;
  width: 100%;
  position: relative;
  height: 47px;
  padding-top: 10px;
  padding-right: 50px;
  padding-bottom: 10px;
  padding-left: 15px;
  border: none;
  resize: none;
  outline: none;
  border: 1px solid #ccc;
  color: #888;
  border-top: none;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
  overflow: hidden;
}

.chat-input > form {
  margin-bottom: 0;
}
#chat-input::-webkit-input-placeholder {
  /* Chrome/Opera/Safari */
  color: #ccc;
}
#chat-input::-moz-placeholder {
  /* Firefox 19+ */
  color: #ccc;
}
#chat-input:-ms-input-placeholder {
  /* IE 10+ */
  color: #ccc;
}
#chat-input:-moz-placeholder {
  /* Firefox 18- */
  color: #ccc;
}
.chat-submit {
  position: absolute;
  bottom: 3px;
  right: 10px;
  background: transparent;
  box-shadow: none;
  border: none;
  color: #e55125;
  width: 35px;
  height: 35px;
}

.type {
  display: none;
  border-radius: 20px;
  background-color: white;
  color: #e55125;
  padding: 2px 8px 4px 8px;
  position: absolute;
  font-size: 13px;
  font-weight: 500;
  left: 10px;
  top: 20px;
}

.chat-logs {
  padding: 15px;
  height: 370px;
  overflow-y: scroll;
}

.chat-logs::-webkit-scrollbar {
  width: 5px;
  background-color: #f5f5f5;
}

.chat-logs::-webkit-scrollbar-thumb {
  background-color: #e55125;
}

@media only screen and (max-width: 500px) {
  .chat-logs {
    height: 40vh;
  }
}

.cm-send {
  color: #565656;
  font-weight: bolder;
}

.cm-time {
  color: #565656;
  font-size: 80%;
  float: right;
}

.cm-fmsg {
  display: flex;
}

.cm-cimg {
  background-image: url("https://bloomindia.in/assets/public/img/bloomindia.png");
  width: 35px;
  height: 36px;
  background-size: 100% 100%;
  float: left;
  margin-right: 15px;
  background-color: #e4e6e7;
  border-radius: 50%;
}

.cm-uimg {
  background-image: url("https://bloomindia.in/assets/public/img/user.png");
  width: 35px;
  height: 36px;
  background-size: 100% 100%;
  border-radius: 50%;
  float: left;
  margin-right: 15px;
}

.cm-msg-text {
  background: white;
  padding: 10px 15px 10px 15px;
  color: #555;
  width: 100%;
  float: left;
  position: relative;
  margin-bottom: 20px;
  border-radius: 5px;
}

.chat-msg {
  clear: both;
}
.chat-msg.self > .cm-msg-text {
  background: white;
  padding: 10px 15px 10px 15px;
  color: #555;
  width: 100%;
  float: left;
  position: relative;
  margin-bottom: 20px;
  border-radius: 5px;
}
.cm-msg-button > ul > li {
  list-style: none;
  float: left;
  width: 50%;
}
.cm-msg-button {
  clear: both;
  margin-bottom: 70px;
}

</style>