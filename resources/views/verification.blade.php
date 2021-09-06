<style>
    .container {
      height: 50px;
      position: relative;
      /* border: 3px solid green; */
    }
    
    .center {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>   
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>{{env('APP_NAME')}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
     <tr>
        <table align="center" border="1" cellpadding="0" cellspacing="0" width="600">
            <tr>
                <td align="center" bgcolor="#F8F8FF" style="padding: 40px 0 30px 0;">
                    <img src="{{env('APP_URL')}}/img/mu.png " width="300" height="300" style="display: block;" />
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                    <table border="1" cellpadding="0" cellspacing="0" width="100%">
                     <tr>
                      <td>
                       <b>{{env('APP_NAME')}}</b>
                      </td>
                     </tr>
                     <tr>
                        <td style="padding: 0px 0 30px 0;" bgcolor="#87CEFA" >
                            <div class="container">
                                <div class="center">
                                    <a href="{{env('APP_URL')."/".$user->activation_token}}" type="button" class="btn btn-danger">Konfirmasi</a>
                                </div>
                            </div>
                        </td>
                     </tr>
                    </table>
                   </td>
            </tr>
            <tr>
             <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <td>
                        <td width="75%">
                            <p style="color:#F5F5F5">&reg; {{env('APP_NAME')}} <br/><br/>
                                Jl. Raya Cipacing No.22, Cipacing, Jatinangor, Kabupaten Sumedang, Jawa Barat 45363</p>
                        </td>
                    </td>
                    <td align="right">
                        <table border="0" cellpadding="0" cellspacing="0">
                         <tr>
                          <td>
                           <a href="http://www.twitter.com/">
                            <img src="{{env('APP_URL')}}/img/twi.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                           </a>
                          </td>
                          <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                          <td>
                           <a href="http://www.twitter.com/">
                            <img src="{{env('APP_URL')}}/img/pngegg(1).png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                           </a>
                          </td>
                         </tr>
                        </table>
                    </td>
             </td>
            </tr>
           </table>
     </tr>
    </table>
   </body>
</html>