
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>
   </head>
   <body>
      

<div style="width:600px;max-width:100%;background:#fff;border-radius:6px;margin:0 auto">
	<div style="text-align: center;"><img src="{{asset('public/admin_assets/images/cycle.png')}}" class="CToWUd a6T" tabindex="0" style=" width: 200px; "></div>
   
   <div class="a6S" dir="ltr" style="opacity: 0.01; left: 626.5px; top: 275.5px;">
      <div id=":wg" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download">
         <div class="akn">
            <div class="aSK J-J5-Ji aYr"></div>
         </div>
      </div>
   </div>
   <div style="padding:0 20px 40px">
      <table style="border-spacing:0;float:right;width:100%;line-height:32px;margin-top:16px;font-size:14px;border-radius:4px">
        
      </table>
      <div style="clear:both"></div>
      <h3 style="font-weight:bold;font-size:24px;line-height:36px;margin:16px 0;color:#1e2026">Authorize New Device </h3>
      <p style="font-weight:normal;margin:16px 0 0 0;color:#474d57">You recently attempted to sign in to your albumer account from a new device or location.                     As a security measure, we require additional confirmation before allowing access to your Albumer account. </p>
      <table style="margin-top:16px;width:100%;background:#fafafa;vertical-align:middle;padding:10px 0 10px;box-sizing:border-box">
         <tbody>
            <tr>
               <td>
                  <table>
                     <tbody>
                      
                        <tr>
                           <td style="vertical-align:text-top;text-align:left;margin-right:3px;color:#76808f;white-space:nowrap;text-align:right;font-size:14px;padding-right:8px;padding-left:8px">                  IP Address:            </td>
                           <td>
                              <div>
                                 <div style="color:#474d57"> {{Request::ip();}}</div>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td style="vertical-align:text-top;text-align:left;margin-right:3px;color:#76808f;white-space:nowrap;text-align:right;font-size:14px;padding-right:8px;padding-left:8px">                  Device:            </td>
                           <td>
                              <div>
                                 <div style="color:#474d57">
                                    <?php
                                        $agent = new \Jenssegers\Agent\Agent;
                                    ?>
                                    {{$agent->browser()}}


                                 </div>

                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
      <p style="font-weight:normal;margin:16px 0 0 0;color:#474d57">If you recognize this activity, please confirm it with the activation code.                Here is your account activation code: </p>

      <div style="font-size:32px;margin-top:16px;color:#1e2026">{{ $mailData['otp']}}</div>


      <p style="font-weight:normal;margin:16px 0 0 0;color:#474d57">If you don't recognize this activity, please  contact our customer support immediately at <a style="text-decoration-line:none;font-weight:normal;line-height:24px;color:#f0b90b" href="{{url('/')}}" target="_blank" data-saferedirecturl="#">{{url('/') }}</a> </p>
      <p style="font-weight:normal;margin:0;font-size:14px;line-height:22px;color:#76808f;margin-top:36px">Bredge Team<br>This is an automated message, please do not reply.</p>
   </div>
</div>


   </body>
</html>
