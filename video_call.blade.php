@extends('layouts.app')
@section('title','Conversation Details')
@push('css')
<style type="text/css">
	.if_rejected{
		background:#ffabab;
	}
    /* .use_vi_info {
        width: 100%;
        height: 100%;
    } */
    .use_vi_info video {
         max-width: 100%;
        height: 100%;
        /* object-fit: cover; */
        /* border-radius: 50%; */
        /*border: 2px solid #ffa700;-*/
        -webkit-box-shadow: 0px 0px 18px 5px rgb(0 0 0 / 5%);
        -moz-box-shadow: 0px 0px 18px 5px rgba(0, 0, 0, 0.05);
        box-shadow: 0px 0px 18px 5px rgb(0 0 0 / 5%);
    }
    video {
        vertical-align: middle;
        border-style: none;
    }
    .muteblur video {
        /* filter: blur(1.2rem); */
        filter: grayscale(100%);
        display: none;
    }
    .muteblur{
        background: #000 !important;
    }
    .top_area_video{

        background: #ffc411f2;
        padding: 3px 6px;
        border-radius: 5px;
    }
    .top_area_video img{
        width: 14px;
        height: 14px;
    }
    a.remove {
        position: relative;
        z-index: 99;
        border-radius: 5px;
        padding: 3px 8px;
        font-size: 14px;
        color: #fff !important;
    }
    a.remove_eviction {
        position: relative;
        z-index: 99;
        border-radius: 5px;
        padding: 3px 8px;
        font-size: 14px;
        color: #fff !important;
    }
    a.warning {
        position: relative;
        z-index: 99;
        border-radius: 5px;
        padding: 3px 8px;
        font-size: 14px;
        color: #fff !important;
    }
    a.report {
        position: relative;
        z-index: 99;
        border-radius: 5px;
        padding: 3px 8px;
        font-size: 14px;
        color: #fff !important;
    }
    .vid_call_btns{
        position: fixed;
        bottom:30px;

    }
    .use_vi_info {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .message_close_div{
        width: 100%;
    }
    .users_cont .top_area_video a{
        box-shadow: -1px 3px 1px 0px #c095127a;
    }
    .connect_profile_modal em{
        width: 50px !important;
        height: 50px !important;
    }
    .connect_profile_modal .host_public_pick_top{
        text-align: left;
        border-bottom: none;
    }
    .connect_profile_modal .host_public_pick_top_image{
        text-align: center !important;
    }
    .host_public_left_inr {
    width: 100%;
    background: #fff;
    border-radius: unset;
    box-shadow: none;
}
.no-show-mod{
    text-align: center;
    display: flex;
    flex-direction: column;
    color: #3f4550;
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    font-size: 16px;
}
.no-show-tm{
    font-size: 28px;
    margin-top: 15px
}
.no-show-inr{
    width: 100%
}
.no-modal{
    padding-bottom:0px !important;
}
.leave_eviction,.openshare{
    position: relative;
    z-index: 99;
    border-radius: 5px;
    padding: 3px 8px;
    font-size: 14px;
    color: #fff !important;
}
#paymenyError .sing_btn{
    padding-top: 11px;
    display: flex;
    justify-content: center;
}
#paymenyError .pg_btn{
    margin: 10px;
    width: auto;
}
.swal-content {
    padding: 0 20px;
    margin-top: 10px !important;
    font-size: 20px !important;
    font-weight: 600;
}
.extend_free{
    color: green;
}
.extend_paid{
    color: green;
}

    @media only screen and (max-width: 767px){
        .top_area_video{
            right: 15px;
            top: unset;
            bottom:15px;
        }
        .users_cont p img{
            height: 15px;
            width: 15px;
        }
        /* a.remove {
            right: 15px;
            top: unset;
            bottom:15px;
        } */
    }
</style>
@endpush
@section('content')

<div class="videos_wrappers div_flexs">
    <div class="video_users_call message_close_div">
        <div class="users_box ">
            <div class="one_users one_users_only" id="media-div">
            </div>
        </div>
    </div>
    <div class="vid_calls_btns">
          <div class="vid_call_btns">
             {{-- <a href="javascript:;" class="cal_re_btns">
                <img src="{{url('public/frontend/images/speaker1.png')}}">
             </a> --}}
             <a href="javascript:;" class="cal_re_btns" id="audio-mute" title="Mute Audio">
                <img src="{{url('public/frontend/images/speaker2.png')}}">
             </a>
             <a href="javascript:;" class="cal_re_btns" id="audio-unmute" title="Unmute Audio" style="display: none">
                <img src="{{url('public/frontend/images/mute-voice.png')}}">
             </a>
             <a href="javascript:;" class="cal_re_btns" id="video-mute" title="Mute Video">
                <img src="{{url('public/frontend/images/speaker3.png')}}" >
             </a>
             <a href="javascript:;" class="cal_re_btns"  id="video-unmute" style="display: none" title = "Unmute Video">
                <img src="{{url('public/frontend/images/no-video.png')}}">
             </a>
             <a href="javascript:;" class="cal_re_btns reds_call" id="button-leave" title="End Call">
                <img src="{{url('public/frontend/images/speaker.png')}}">
             </a>
             <a href="javascript:;" class="cal_re_btns" id="openMessage">
                <img src="{{url('public/frontend/images/comment.png')}}">
             </a>
             <a href="javascript:;" class="cal_re_btns" id="cloceMessage" style="display: none">
                <img src="{{url('public/frontend/images/comment.png')}}">
             </a>
             <div class="chat_notification_div">
                 <span></span>
             </div>
          </div>
    </div>
    <div class="video_messa" style="display: none">
        <div class="messages_rigrt">
            <div class="messages_rigrt_top">
                <h5>Chat</h5>
                <a href="javascript:;" id="messageCloseNew"> <i class="icofont-close"></i></a>
            </div>
            <div class="messages_rigrt_inr">
                <div class="messa_rigrt_body_panel">
                    <div class="messages_rigrt_body">
                        {{-- <div class="chat_mass_itm">
                            <div class="media">
                                <em><img src="images/chat_img1.jpg" alt=""></em>
                                <div class="media-body">
                                    <h5>Mark Dacascos</h5>
                                    <div class="chat_mass_bx">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typeset</p>
                                    </div>
                                    <span>30Min ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat_mass_itm chat_mass_itm_rig">
                            <div class="media">
                                <em><img src="images/chat_img5.jpg" alt=""></em>
                                <div class="media-body">
                                    <div class="chat_mass_bx">
                                        <p>Lorem Ipsum is simply text  referred to as 'lipsum', </p>
                                    </div>
                                    <span>10min ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat_mass_itm">
                            <div class="media">
                                <em><img src="images/chat_img1.jpg" alt=""></em>
                                <div class="media-body">
                                    <h5>Mark Dacascos</h5>
                                    <div class="chat_mass_bx">
                                        <p>Lorem Ipsum is simply dummy text of the printing .</p>
                                    </div>
                                    <span>30Min ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat_mass_itm chat_mass_itm_rig">
                            <div class="media">
                                <em><img src="images/chat_img5.jpg" alt=""></em>
                                <div class="media-body">
                                    <div class="chat_mass_bx">
                                        <p> written and approved. It originally comes from a Latin text, but to today's reader</p>
                                    </div>
                                    <span>10min ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat_mass_itm">
                            <div class="media">
                                <em><img src="images/chat_img1.jpg" alt=""></em>
                                <div class="media-body">
                                    <h5>Mark Dacascos</h5>
                                    <div class="chat_mass_bx">
                                        <p>Lorem Ipsum is simply dummy text of the printing .</p>
                                    </div>
                                    <span>30Min ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat_mass_itm chat_mass_itm_rig">
                            <div class="media">
                                <em><img src="images/chat_img5.jpg" alt=""></em>
                                <div class="media-body">
                                    <div class="chat_mass_bx">
                                        <p> written and approved. It originally comes from a Latin text, but to today's reader</p>
                                    </div>
                                    <span>10min ago</span>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <div class="mass_from">
                    <form action="javascript:;" id="messageSendForm">
                        <input type="hidden" id="conversation_id" value="{{Request::segment(2)}}">
                        <div class="mass_send">
                            <div class="mass_send_bx">
                                <textarea placeholder="Write your message ..." id="textMessage"></textarea>
                                {{-- <span class="file_in">
                                    <input type="file" name="file" id="file">
                                    <label for="file"><img src="{{url('public/frontend/images/atac.png')}}" alt=""></label>
                                </span> --}}
                                <div class="plen_btn_bx">
                                    <button class="plen_btn"><img src="{{url('public/frontend/images/plen.png')}}" alt=""></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
</div>
<div class="modal popup_list sign_popup" id="openConnect">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="{{url('public/frontend/images/popcross.png')}}"></button>
            </div>
            <div class="modal-body">
                <div class="sign_popup_body">
                    <div class="singup_right_inr connect_user_data">
                        {{-- <h1>Connect</h1> --}}
                        <form id="profileShow">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal popup_list sign_popup" id="askToLeave">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <button type="button" class="close" data-dismiss="modal"><img src="{{url('public/frontend/images/popcross.png')}}"></button> --}}
            </div>
            <div class="modal-body no-modal">
                <div class="sign_popup_body">
                    <div class="singup_right_inr no-show-inr">
                        {{-- <h1>Connect</h1> --}}
                        <form id="profileShow" class="no-show-mod">
                            Two participants have asked you to leave this conversation. You will be removed in :
                            <span id="timer">
                                <span id="time" class="no-show-tm">00:10</span>
                            </span>
                            <div class="sing_btn">
                                <a href="javascript:;" class="pg_btn" data-dismiss="modal">Leave</a>
                            </div>`
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade what_modal" id="myModalshare">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="share_slidars">
					<div class="share_icon_slid">
						<div class="owl-carousel">
							<div class="item">
								<div class="st-custom-button modalshare" data-network="facebook" data-url="#">
									<em><i class="icofont-facebook"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="whatsapp" data-url="#">
									<em><i class="icofont-whatsapp"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="twitter" data-url="#">
									<em><i class="icofont-twitter"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="linkedin" data-url="#">
									<em><i class="icofont-linkedin"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="snapchat" data-url="#">
									<em><i class="icofont-snapchat"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="reddit" data-url="#">
									<em><i class="icofont-reddit"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="pinterest" data-url="#">
									<em><i class="icofont-pinterest"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="email" data-url="#">
									<em><i class="icofont-envelope"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="telegram" data-url="#">
									<em><i class="icofont-paper-plane"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="evernote" data-url="#">
									<em><i class="evernote"><img src="{{url('public/frontend/images/evernote-brands.png')}}"></i></em>
								</div>
							</div>
							<div class="item">
								<div class="st-custom-button modalshare" data-network="googlebookmarks" data-url="#">
									<em><i class="sos_gool_io_c"><img src="{{url('public/frontend/images/social_google.png')}}" alt=""></i></em>
								</div>
							</div>
							<div class="item">
								<div class="modalshare copyLink" onclick="copyToClipboard()">
									<em><i class="icofont-link"></i></em>
									<input type="text" placeholder="enter your address" id="myInput" style="opacity: 0;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal popup_list sign_popup" id="paymenyError">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="{{url('public/frontend/images/popcross.png')}}"></button>
            </div>
            <div class="modal-body">
                <div class="sign_popup_body rule">
                    <div class="singup_right_inr">
                        <h1>Extend Your Call</h1>
                        <div class="alert" id="popupConversationalert" style="display: none;">

                        </div>
                        <form >
                            <div class="singup_form">
                                {{-- <div class="row">
                                    <div class="col-sm-12">
                                    <h4>Rules Of Engagement</h4>
                                    </div>
                                    <div class="col-sm-12">
                                        <ul style="list-style: decimal; padding: 1px 0px 0px 20px;">
                                            <li class="popupbulates">Speak with authenticity</li>
                                            <li class="popupbulates">Listem with intent</li>
                                            <li class="popupbulates">Engage with respect </li>
                                            <li class="popupbulates">No Recording</li>
                                            <li class="popupbulates">Do not ask or share personal contact details.</li>
                                        </ul>

                                    </div>
                                </div> --}}

                                <div class="sing_btn">
                                    {{-- <button class="pg_btn" >Enter</button> --}}
                                    <a class="pg_btn" href="javascript:void(0);" data-dismiss="modal">Cancel</a>
                                    <a class="pg_btn" href="javascript:;" id="extendCall">Extend </a>
                                    <a class="pg_btn" href="{{route('purchase.package')}}" target="_blank">Purches Ycoin</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=#{property?._id}&product=custom-share-buttons" defer></script>
<script type="text/javascript">
    var indexxx = $('.video_messa').height();
    var height=0;
    // $(document).ready(function() {

        $('body').on('keydown','#textMessage',function(event) {

        // enter has keyCode = 13, change it if you want to use another button
        if (event.keyCode == 13) {
            console.log(event.keyCode)
            // $('#messageSendForm').submit();
            // return false;
            event.target.form.dispatchEvent(new Event("submit", {cancelable: true}));
            event.preventDefault(); // Prevents the addition of a new line in the text field (not needed in a lot of cases)
        }
        });
    // });
    $('#messageSendForm').validate({
        submitHandler: function(form){
            if($('#file').val()=='' && $('#textMessage').val()==''){
                return false;
            }
            var conversation_id =  $('#conversation_id').val();
            var message =  $('#textMessage').val();
            // var files = $('#file')[0].files;

            data = new FormData();
            data.append('_token', "{{ csrf_token() }}");
            data.append('conversationId',conversation_id);
            data.append('message',message);
            // data.append('file', files[0]);

            $.ajax({
                url:"{{route('send.message')}}",
                type: 'POST',
                dataType: 'JSON',
                data:data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false
            })
            .done(function(response) {
            $('#textMessage').val('');
            $('#file').val('');
            let msg='';
            response.result.forEach(function(item, index){
                senderName=item.get_sender.profile_name;
                if(item.file_name !== null){
                    file = "{{url('storage/app/public/message_files/')}}";
                    file = file+'/'+item.file_name;
                    filename=item.file_name.substr(item.file_name.lastIndexOf("_")+1)
                    attach_file=`${item.message?'<br>':''}<a href="${file}" class="msg-link-color" target=_blank>${filename}</a>`;
                }else{
                    attach_file=``;
                }
                if(item.user_id=="{{auth()->user()->id}}"){
                    msg+=`
                    <div class="chat_mass_itm chat_mass_itm_rig">
                        <div class="media">
                            <div class="media-body">
                                <h5>You</h5>
                                <div class="chat_mass_bx">
                                    <p>${item.message?item.message:''}${attach_file}</p>
                                </div>
                                <span><img src="{{URL::to('public/frontend/images/mt.png')}}"> ${getTimeDiff(item.created_at)}</span>
                            </div>
                        </div>
                    </div>`;
                }
            });
                $('.messages_rigrt_body').append(msg);
                indexxx += $('.messa_rigrt_body_panel').height();
                $('.messages_rigrt_body .chat_mass_itm').each(function(i , value){
                    height+=parseInt($(this).height());
                })
                $(".messages_rigrt_body").animate({ scrollTop: height}, 1000);

            }).fail(function(error) {
                console.log("error", error);
            })
            .always(function() {
                console.log("complete");
            });
        }
    });
    $('body').on('click','#cloceMessage',function(){
        $('.video_users_call').addClass('message_close_div');
        $('.video_messa').css('display','none');
        $('#openMessage').css('display','flex');
        $('#cloceMessage').css('display','none');
        $('.message_close_div').show();
        $('.vid_calls_btns').show();
    });
    $('body').on('click','.openshare',function(){
        console.log('CALL')
		$('#myModalshare').modal('show');
		$('.modalshare').attr('data-url',"{{ route('conversation.details.page') }}{{Request::segment(2)}}");
		$('input#myInput').attr('value','{{ route('conversation.details.page') }}{{Request::segment(2)}}');
	});


    $('body').on('click','#openMessage',function(){
        if (window.matchMedia('(max-width: 575px)').matches) {
        //...
        $('.message_close_div').css('display','none');
        $('.vid_calls_btns').css('display','none');
        } else {
            //...
        }

        $('.chat_notification_div').hide();
        $('.video_users_call').removeClass('message_close_div');
        $('.video_messa').css('display','block');
        $('#cloceMessage').css('display','flex');
        $('#openMessage').css('display','none');

        let conversationId='{{Request::segment(2)}}';
        var message =  $('#textMessage').val();
        var reqData = {
            'jsonrpc': '2.0',
            '_token': '{{csrf_token()}}',
            'params': {
                conversationId: conversationId,
            }
        };
        $.ajax({
            url:"{{route('fetch.message')}}",
            type: 'post',
            dataType: 'json',
            data: reqData,
        })
        .done(function(response) {
            $('.messages_rigrt_body').html('');
            let msg='';
            console.log(response)
            response.result.forEach(function(item, index){

                senderName= response.allUser[item.user_id] !=null? response.allUser[item.user_id] :item.get_sender.profile_name;
                if(item.file_name !== null){
                    file = "{{url('storage/app/public/message_files/')}}";
                    file = file+'/'+item.file_name;
                    filename=item.file_name.substr(item.file_name.lastIndexOf("_")+1)
                    attach_file=`${item.message?'<br>':''}<a href="${file}" class="msg-link-color" target=_blank>${filename}</a>`;
                }else{
                    attach_file=``;
                }
                if(item.user_id=="{{auth()->user()->id}}"){
                    msg+=`
                    <div class="chat_mass_itm chat_mass_itm_rig">
                        <div class="media">

                            <div class="media-body">
                                <h5>You</h5>
                                <div class="chat_mass_bx">
                                    <p>${item.message?item.message:''}${attach_file}</p>
                                </div>
                                <span><img src="{{URL::to('public/frontend/images/mt.png')}}"> ${getTimeDiff(item.created_at)}</span>
                            </div>
                        </div>
                    </div>`;

                }else{
                    msg+=`
                    <div class="chat_mass_itm">
                        <div class="media">
                            <div class="media-body">
                                <h5>${senderName}</h5>
                                <div class="chat_mass_bx">
                                    <p>${item.message?item.message:''}${attach_file}</p>
                                </div>
                                <span><img src="{{URL::to('public/frontend/images/mt.png')}}"> ${getTimeDiff(item.created_at)}</span>
                            </div>
                        </div>
                    </div>`;

                }

            });
            $('.messages_rigrt_body').append(msg);

            $('.messages_rigrt_body .chat_mass_itm').each(function(i , value){
                height+=parseInt($(this).height());
            })
            indexxx += $('.messa_rigrt_body_panel').height();
            $(".messages_rigrt_body").animate({ scrollTop: height}, 1000);

        }).fail(function(error) {
            console.log("error", error);
        })
        .always(function() {
            console.log("complete");
        });
    })
    $('body').on('click','#messageCloseNew',function(){
        $('.video_users_call').addClass('message_close_div');
        $('.video_messa').css('display','none');
        $('#openMessage').css('display','flex');
        $('#cloceMessage').css('display','none');
        $('.message_close_div').show();
        $('.vid_calls_btns').show();
    })
</script>

<script>
    var allReportedUserId=[];
    @foreach (@$report as $itemReport)
    allReportedUserId.push('{{$itemReport}}');
    @endforeach

    var allEvictionUserId=[];
    @foreach (@$eviction as $itemEviction)
    allEvictionUserId.push('{{$itemEviction}}');
    @endforeach
</script>


<script>
    localStorage.setItem('identity','{{@$userNameIdentity}}-{{auth()->user()->id}}');
    var homeUrl="{{route('welcome')}}";
    var authUserID="{{auth()->user()->id}}";
</script>



<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script> --}}
<script src="{{url('public/frontend/js/bootstrap.js')}}"></script>

{{-- <script src="//sdk.twilio.com/js/video/releases/2.21.1/twilio-video.min.js"></script> --}}
<script src="//media.twiliocdn.com/sdk/js/video/releases/2.3.0/twilio-video.min.js"></script>

<script>
$(document).ready(function(){
    @if($conversationDetails->type!='ON')
    startTimerForCall();
    @endif
    // askToLeave();
    var ExtendTimeSecond = '{{env('ExtendTimeSecond')}}';
    var ExtendTimeMinute = '{{env('ExtendTimeMinute')}}';
    var conversationDetailsDa='{{$conversationDetails->no_of_extend}}';
    if(conversationDetailsDa==0){
        var callextendTime='F';
    }else{
        var callextendTime='P';
    }
    $('.chat_notification_div').hide();
    shareRemve()
    @if(@$callEndTime>0)
    openCallExtend(callextendTime,'{{$callEndTime}}');
    @endif
})
    navigator.mediaDevices.getUserMedia({ audio: true, video:true })
        .then(function(stream) {
            /* use the stream */
            $.getScript( "{{URL::to('public/frontend/js/twilio-quickstart.js') }}", function() {
                // start video call
                roomName = '{{Request::segment(2)}}';
                var reqData = {
                    roomName: roomName
                };
                // console.log(tokenUrl)
                $.getJSON('get-twilio-token/room', reqData, function(data) {
                    identity = data.identity;

                    var connectOptions = {
                        name: roomName,
                        // logLevel: 'debug',
                        _useTwilioConnection: true,
                        audio: { name: 'microphone' },
                        video: { name: 'camera' },
                        dominantSpeaker: true
                    };

                    if (previewTracks) {
                        connectOptions.tracks = previewTracks;
                    }

                    // Join the Room with the token from the server and the
                    // LocalParticipant's Tracks.
                    Video.connect(data.token, connectOptions).then(roomJoined, function(error) {
                    });


                });
            })

        })
        .catch(function(err) {
            /* handle the error */
            console.log(err)
            swal({
                title: err,
                text: "Camera and microphone permision block please allow permision for video call",
                icon: "info",
                // buttons: ['Cancle', 'OK'],
                dangerMode: true,
            });
        });

    function returnHome(){
        location.href="{{route('home')}}";
    }

    $('body').on('click', '.remove', function() {
        var sid=$(this).data('id');
        var roomId=$(this).data('roomid');
        var userId=$(this).data('userid');
        var currentContent =$(this);
        swal({
            // title: "New video call request",
            text: "Do you want ask to leave this user?",
            icon: "info",
            buttons: ['Cancle', 'OK'],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var reqData = {
                    'jsonrpc' : '2.0',
                    '_token' : '{{csrf_token()}}',
                    'params' : {
                        'sid' : sid,
                        'roomId':roomId,
                        'userId':userId,
                    }
                };
                $.ajax({
                    url: "{{ route('remove.user') }}",
                    method: 'post',
                    dataType: 'json',
                    data: reqData,
                    success: function(response){
                        currentContent.hide();
                        $(".remove_eviction[data-userid="+userId+"]").show();
                        // console.log(response);
                        // if(response.result.call_complete==1){
                        //     activeRoom.disconnect();

                        // }
                    }, error: function(error) {
                        console.log(error)
                    }
                });
            } else {
                return false;
            }
        });
    });

    $('body').on('click', '.remove_eviction', function() {
        var sid=$(this).data('id');
        var roomId=$(this).data('roomid');
        var userId=$(this).data('userid');
        var currentContent =$(this);
        swal({
            // title: "New video call request",
            text: `Do you want revoke "ask to leave" for this user?`,
            icon: "info",
            buttons: ['Cancle', 'OK'],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var reqData = {
                    'jsonrpc' : '2.0',
                    '_token' : '{{csrf_token()}}',
                    'params' : {
                        'sid' : sid,
                        'roomId':roomId,
                        'userId':userId,
                    }
                };
                $.ajax({
                    url: "{{ route('remove.eviction.request') }}",
                    method: 'post',
                    dataType: 'json',
                    data: reqData,
                    success: function(response){
                        currentContent.hide();
                        $(".remove[data-userid="+userId+"]").show();
                        // console.log(response);
                        // if(response.result.call_complete==1){
                        //     activeRoom.disconnect();

                        // }
                    }, error: function(error) {
                        console.log(error)
                    }
                });
            } else {
                return false;
            }
        });
    });


    $('body').on('click', '.warning', function() {
        var sid=$(this).data('id');
        var roomId=$(this).data('roomid');
        var userId=$(this).data('userid');
        swal({
            // title: "New video call request",
            text: "Do you want to send an alert to the user?",
            icon: "info",
            buttons: ['Cancle', 'OK'],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var reqData = {
                    'jsonrpc' : '2.0',
                    '_token' : '{{csrf_token()}}',
                    'params' : {
                        'sid' : sid,
                        'roomId':roomId,
                        'userId':userId,
                    }
                };
                $.ajax({
                    url: "{{ route('warning.user') }}",
                    method: 'post',
                    dataType: 'json',
                    data: reqData,
                    success: function(response){
                        // console.log(response);
                        // if(response.result.call_complete==1){
                        //     activeRoom.disconnect();

                        // }
                    }, error: function(error) {
                        console.log(error)
                    }
                });
            } else {
                return false;
            }
        });
    });
    function removeButtonRemove(){
        var userId='{{auth()->user()->id}}';
        var mainUser='{{@$is_creator}}';
        if(mainUser!='yes'){
            $( ".remove" ).remove();
        }
    }
    var totarticipant=1;

    function totalParticipantList(id){
        totarticipant=1+id;
        console.log('Call totalParticipant'+ id)
        $('.remove').show();
        if(id==0){
            $('.remove').hide();
            $('#media-div').addClass('one_users_only');
            $('#media-div').removeClass('two_users');
            $('#media-div').removeClass('three_users');
            $('#media-div').removeClass('four_users');
            $('#media-div').removeClass('five_users');
        }
        else if(id==1){
            $('.remove').hide();
            $('#media-div').addClass('two_users');
            $('#media-div').removeClass('three_users');
            $('#media-div').removeClass('four_users');
            $('#media-div').removeClass('five_users');
            $('#media-div').removeClass('one_users_only');
        }
        else if(id==2){
            $('#media-div').addClass('three_users');
            $('#media-div').removeClass('two_users');
            $('#media-div').removeClass('four_users');
            $('#media-div').removeClass('five_users');
            $('#media-div').removeClass('one_users_only');
        }
        else if(id==3){
            $('#media-div').addClass('four_users');
            $('#media-div').removeClass('two_users');
            $('#media-div').removeClass('three_users');
            $('#media-div').removeClass('five_users');
            $('#media-div').removeClass('one_users_only');
        }
        else if(id==4){
            $('#media-div').addClass('five_users');
            $('#media-div').removeClass('two_users');
            $('#media-div').removeClass('three_users');
            $('#media-div').removeClass('four_users');
            $('#media-div').removeClass('one_users_only');
        }
        else{
            $('#media-div').removeClass('two_users');
            $('#media-div').removeClass('three_users');
            $('#media-div').removeClass('four_users');
            $('#media-div').removeClass('five_users');
            $('#media-div').removeClass('one_users_only');
        }
        // one_users two_users three_users four_users five_users
    }

    channel.bind('warning-event', function(data) {
        newmsg = data.message;
        var conversionId = data.conversation_id;
        auth_id='{{auth()->user()->id}}';
        if(data.to_id==auth_id){
            swal({
                title: "Alert",
                text: newmsg,
                icon: "warning",
                // buttons: ['OK'],
                // dangerMode: true,
            })
        }
    });
    channel.bind('eviction-event', function(data) {
        newmsg = data.message;
        var conversionId = data.conversation_id;
        auth_id='{{auth()->user()->id}}';
        if(data.to_id==auth_id){
            if(data.evict_type==1){
                swal({
                    title: "Asked to leave",
                    text: newmsg,
                    icon: "error",
                    timer: 10000,
                }).then((willDelete) => {

                        $('.leave_eviction').show();
                        $('.top_area_video_user').show();
                });
            }else{
                askToLeave();
            }
            // swal({
            //     title: "Eviction",
            //     text: newmsg,
            //     icon: "error",
            //     timer: 10000,
            // }).then((willDelete) => {
            //     switch (willDelete) {
            //         case "Yes":
            //         console.log('Yes');
            //         returnHome();
            //         break;

            //         default:
            //         console.log('ignore');
            //         returnHome();
            //     }
            // });
        }
    });

    channel.bind('eviction-event-remove', function(data) {
        newmsg = data.message;
        var conversionId = data.conversation_id;
        auth_id='{{auth()->user()->id}}';
        if(data.to_id==auth_id){
            swal({
                title: "Asked to leave ",
                text: `"Asked to leave" alert is removed by the user.`,
                icon: "info",
                timer: 10000,
            }).then((willDelete) => {

            });
            if(data.evict_type==0){
                // $('.leave_eviction').hide();
                if($('.share').css('display') == 'none'){
                    $('.leave_eviction').hide();
                    $('.top_area_video_user').hide();
                }else{
                    $('.leave_eviction').hide();
                }

            }else{
                $('.leave_eviction').show();
                $('.top_area_video_user').show();
            }
        }
    });

    function  updateCallTime(userId,roomId){
        var sid='';
        var roomId=roomId;
        var userId=userId;
        var reqData = {
            'jsonrpc' : '2.0',
            '_token' : '{{csrf_token()}}',
            'params' : {
                'sid' : sid,
                'roomId':roomId,
                'userId':userId,
            }
        };
        $.ajax({
            url: "{{ route('update.call.time') }}",
            method: 'post',
            dataType: 'json',
            data: reqData,
            success: function(response){
                // console.log(response);
                // if(response.result.call_complete==1){
                //     activeRoom.disconnect();

                // }
            }, error: function(error) {
                console.log(error)
            }
        });
    }

    function callDisconnectConfirm(){
        swal({
            title: "Call End Confirmation ",
            text: "Are you done with the call?",
            icon: "info",
		    dangerMode: true,
            buttons: true,
            buttons: {
                catch: {
                    text: "No",
                    value: "No",
                    className:"swal-button--danger"
                },
                default: {
                    text: "Yes",
                    value: "Yes",
                    className:"swal-button--cancel"
                },
            },
        })
        .then((willDelete) => {
            switch (willDelete) {
                case "Yes":
                location.href="{{route('welcome')}}/past-conversation-details-{{Request::segment(2)}}";
                break;

                case "No":
                location.href="{{route('welcome')}}/video-call/{{Request::segment(2)}}";

                break;

                default:
                location.href="{{route('welcome')}}/past-conversation-details-{{Request::segment(2)}}";
            }

        });
    }

    $('body').on('click', '.report', function() {
        var sid=$(this).data('id');
        var roomId=$(this).data('roomid');
        var userId=$(this).data('userid');
        var currentContent =$(this);

        swal({
            // title: "New video call request",
            text: "Do you want to report this user?",
            icon: "info",
            // buttons: ['Cancle', 'OK'],
            dangerMode: true,
            buttons: true,
            buttons: {
                catch: {
                    text: "NO",
                    value: "No",
                    className:"swal-button--danger"
                },
                default: {
                    text: "YES",
                    value: "Yes",
                    className:"swal-button--cancel"
                },
            },
        })
        .then((willDelete) => {
            switch (willDelete) {
                case "Yes":
                    if (willDelete) {
                        var reqData = {
                            'jsonrpc' : '2.0',
                            '_token' : '{{csrf_token()}}',
                            'params' : {
                                'sid' : sid,
                                'roomId':roomId,
                                'userId':userId,
                            }
                        };
                        $.ajax({
                            url: "{{ route('report.user') }}",
                            method: 'post',
                            dataType: 'json',
                            data: reqData,
                            success: function(response){

                                currentContent.hide();

                                // console.log(response);
                                // if(response.result.call_complete==1){
                                //     activeRoom.disconnect();

                                // }
                            }, error: function(error) {
                                console.log(error)
                            }
                        });
                    } else {
                        return false;
                    }
                break;
            }
        });
    });
    $('body').on('click', '.connectUserShow', function() {
        var userId=$(this).data('connectid');
        var reqData = {
            'jsonrpc' : '2.0',
            '_token' : '{{csrf_token()}}',
            'params' : {
                'userId':userId,
                'roomId':'{{Request::segment(2)}}',
            }
        };
        $.ajax({
            url: "{{ route('connect.user.public.profile') }}",
            method: 'post',
            dataType: 'json',
            data: reqData,
            success: function(response){
                // console.log(response);
                // if(response.result.call_complete==1){
                //     activeRoom.disconnect();

                // }
                var userProfileData=response.result.data
                console.log(userProfileData)
                var html='';3
                var gender='';
                if(userProfileData.gender=='M'){
                    gender = `<h5>Gender - <strong> Male</strong>  </h5> `;
                }
                else if(userProfileData.gender=='F'){
                    gender = `<h5>Gender - <strong> Female</strong>  </h5> `;
                }
                else if(userProfileData.gender=='N'){
                    gender = `<h5>Gender - <strong> Non Binary</strong>  </h5> `;
                }
                else if(userProfileData.gender=='O'){
                    gender = `<h5>Gender - <strong> Others</strong>  </h5> `;
                }else{
                    gender='';
                }
                var profileImage='';
                if(userProfileData.image !== null){
                    file = "{{url('storage/app/public/customer/profile_pics')}}/"+userProfileData.image;
                    profileImage=file ;
                }else{
                    file = "{{url('public/frontend/images/default_pic.png')}}";
                    profileImage=file ;
                }
                var display ='';
                if(userProfileData.is_anonymously=='Y'){
                    display='';
                }else{
                    display=`<div class="sing_btn">
                        <a href="javascript:;" class="pg_btn" onclick="sendConnectRequest(${userProfileData.id})" >Send Connect Request</a>
                    </div>`
                }
                var display ='';
                var publicProfile='{{route('welcome')}}'+'/public-profile/'+userProfileData.id;
                if(userProfileData.is_anonymously=='Y'){
                    display='';
                    var publicProfile='javascript:;';
                }else{
                    display=`<div class="sing_btn">
                        <a href="javascript:;" class="pg_btn" onclick="sendConnectRequest(${userProfileData.id})" >Send Connect Request</a>
                    </div>`
                }

                var html = `
                <div class="singup_form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="host_public_left_inr">
                                <div class="row connect_profile_modal">
                                    <div class="col-12">
                                        <div class="host_public_pick">
                                            <div class="host_public_pick_top host_public_pick_top_image">
                                                <em>
                                                    <img src="${profileImage}" alt="">
                                                </em>
                                                <div class="host_public_pick">
                                                    <div class="host_public_pick_top">
                                                        <h4> <a href="${publicProfile}" target="_blank">${userProfileData.profile_name}</a> </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="host_public_pick">
                                            <div class="host_public_pick_top">
                                                <h5>Your Takes : </h5>
                                                <p>${userProfileData.conversation_text}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   ${display}
                </div>
                `;

                $('#profileShow').html(html);
                $('#openConnect').modal('show');
            }, error: function(error) {
                console.log(error)
            }
        });

    });

    function sendConnectRequest($id){
        userToConnect($id);
        $('#openConnect').modal('hide');
    }

    function checkReportAdded(id){
        if(jQuery.inArray(id, allReportedUserId) !== -1){
            $(".report[data-userid="+id+"]").hide();
        }
    }
    function checkEvictionAdded(id){
        if(jQuery.inArray(id, allEvictionUserId) !== -1){
            $(".remove_eviction[data-userid="+id+"]").show();
            $(".remove[data-userid="+id+"]").hide();
        }
    }
    $('#askToLeave').on('hidden.bs.modal', function () {
        // location.href="{{route('welcome')}}/past-conversation-details-{{Request::segment(2)}}";
        leaveCallEviction(1);
    })
    function userToConnect(hostIds){
			if(hostIds != '')
			{
				$.ajax({
					url:"{{ route('request.send.users') }}",
					type:"POST",
					data: {"_token":'{{ csrf_token() }}','to_user_id':hostIds},
					success:function(responce){
						if (responce == 1) {
							toastr.success('Request sent successfully.');
						}
						else if(responce == 0){
							toastr.success('Request already sent for this user.');
						}
					},
					error:function(xhr){
						console.log(xhr);
					}
				})
			}
		}


</script>
<script>
    function getTimeDiff(datetime) {
        var date =  new Date(datetime);
        var cur=new Date();
        // console.log(date);
        if(date.getDate()==cur.getDate()){
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
        }else{
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var dd = date. getDate();
            var mm = date.toLocaleString('default', { month: 'short' });;
            var yyyy = date. getFullYear();
            var strTime = dd+'-'+mm+'-'+yyyy+' '+hours + ':' + minutes + ' ' + ampm;

        }
        return strTime;
    }
    function askToLeave(){
        var counter = 10;
        $('#askToLeave').modal('show');
       var interval= setInterval(function() {
            counter--;
            // Display 'counter' wherever you want to display it.
            if (counter < 0) {
                clearInterval(interval);
                $('#askToLeave').modal('hide');
                // $('#timer').html("<h3>Count down complete</h3>");
                return;
            }else{
                $('#time').text('00:0'+counter);
                // console.log("Timer --> " + counter);
            }
        }, 1000);
    }

    $('body').on('click', '.leave_eviction', function() {
        var sid=$(this).data('id');
        leaveCallEviction(sid);

    })
    $('body').on('click', '#extendCall', function() {
        $('#paymenyError').modal('hide');
        var ExtendTimeSecond = '{{env('ExtendTimeSecond')}}';
        requestForExtentation('P',ExtendTimeSecond);

    })
    function leaveCallEviction(sid){
        var sid=sid;
        var roomId='{{Request::segment(2)}}';
        var userId=authUserID;
        var reqData = {
            'jsonrpc' : '2.0',
            '_token' : '{{csrf_token()}}',
            'params' : {
                'sid' : sid,
                'roomId':roomId,
                'userId':userId,
            }
        };
        $.ajax({
            url: "{{ route('leave.eviction') }}",
            method: 'post',
            dataType: 'json',
            data: reqData,
            success: function(response){
                activeRoom.disconnect();
                $('#local-video-mute').hide();
                updateCallTime(authUserID,roomName);
                location.href="{{route('welcome')}}/past-conversation-details-{{Request::segment(2)}}";
            }, error: function(error) {
                console.log(error)
            }
        });
    }
    $('body').on('click', '#button-leave', function() {
        swal({
            title: "Do you want to leave the call ?",
            icon: "info",
            // buttons: ['Cancle', 'OK'],
		    dangerMode: true,
            // timer: 15000,
            buttons: true,
            buttons: {
                default: {
                    text: "NO",
                    value: "No",
                    className:"swal-button--cancel"
                },
                catch: {
                    text: "Leave temporarily",
                    value: "yes_temporarily",
                    className:"swal-button--danger"
                },
                catch1: {
                    text: "Leave permanently",
                    value: "yes_permanently",
                    className:"swal-button--danger"
                },

            },
        })
        .then((willDelete) => {
            switch (willDelete) {

                case "yes_temporarily":
                console.log('yes_temporarily');
                activeRoom.disconnect();
                updateCallTime(authUserID,roomName);
                location.href="{{route('welcome')}}/past-conversation-details-{{Request::segment(2)}}";
                break;
                case "yes_permanently":
                console.log('yes_permanently');
                activeRoom.disconnect();
                paramentLeave();
                break;

                case "No":
                console.log('No');
                break;

                default:
                console.log('ignore');
            }
        })
    });
    function paramentLeave(){
        var roomId='{{Request::segment(2)}}';
        var userId=authUserID;
        var reqData = {
            'jsonrpc' : '2.0',
            '_token' : '{{csrf_token()}}',
            'params' : {
                'roomId':roomId,
                'userId':userId,
            }
        };
        $.ajax({
            url: "{{ route('parament.leave') }}",
            method: 'post',
            dataType: 'json',
            data: reqData,
            success: function(response){
                activeRoom.disconnect();
                $('#local-video-mute').hide();
                updateCallTime(authUserID,roomName);
                location.href="{{route('welcome')}}/past-conversation-details-{{Request::segment(2)}}";
            }, error: function(error) {
                console.log(error)
            }
        });
    }

    function shareRemve(){
        var counter = 60*10;
        setInterval(function() {
            counter--;
            // Display 'counter' wherever you want to display it.
            if (counter < 0) {
                if($('.leave_eviction').css('display') == 'none'){
                    $('.share').hide();
                    $('.top_area_video_user').hide();
                }else{
                    $('.share').hide();
                }
                return;
            }else{
                // console.log("Timer --> " + counter);
            }
        }, 1000);
    }

    function openCallExtend(type,time){
        var type= type;
        var ExtendTimeSecond = '{{env('ExtendTimeSecond')}}';
        var span = document.createElement("span");
        var textCall= type=='F'?"Do you want to extend the call for another 60 minutes?": "Are you Extend Your Call 60 minite this is paid?"
        if(type=='F'){
            span.classList.add("extend_free");
            span.innerHTML = "This is Free";
        }else{
            span.classList.add("extend_paid");
            span.innerHTML = "Charge 200 Coins";
        }
        var counter = time;
        var startTimeInterval= setInterval(function() {
            counter--;
            if (counter < 0) {
                clearInterval(startTimeInterval);
                swal({
                    // title: "New video call request",
                    text: 'Do you want to extend the call for another 60 minutes?',
                    icon: "info",
                    dangerMode: true,
                    buttons: true,
                    content: span,
                    buttons: {
                        default: {
                            text: "NO",
                            value: "No",
                            className:"swal-button--cancel"
                        },
                        catch: {
                            text: "Yes",
                            value: "yes",
                            className:"swal-button--danger"
                        },
                    },
                })
                .then((willDelete) => {
                    switch (willDelete) {
                        case "yes":
                        requestForExtentation(type,ExtendTimeSecond)
                        console.log('Yes');
                        break;
                        case "No":
                        console.log('No');
                        break;

                        default:
                        console.log('ignore');
                    }
                });
                return;
            }else{
                // console.log("Timer --> " + counter);
            }
        }, 1000);
    }

    function requestForExtentation(type,time){
        var ExtendTimeSecond = '{{env('ExtendTimeSecond')}}';
        var roomId='{{Request::segment(2)}}';
        var userId=authUserID;
        var reqData = {
            'jsonrpc' : '2.0',
            '_token' : '{{csrf_token()}}',
            'params' : {
                'roomId':roomId,
                'userId':userId,
            }
        };
        $.ajax({
            url: "{{ route('extend.call') }}",
            method: 'post',
            dataType: 'json',
            data: reqData,
            success: function(response){
                if(response.error){
                    $('#popupConversationalert').removeClass('alert-success');
                    $('#popupConversationalert').addClass('alert-danger');
                    $('#popupConversationalert').html('You have not enough ycoin balance extend your call please purchase ycoin and click on extend button.');
                    $('#popupConversationalert').show();
                    $('#paymenyError').modal('show');
                }else{
                    openCallExtend('P',ExtendTimeSecond);
                }
            }, error: function(error) {
                console.log(error)
            }
        });

    }
</script>
<script src="{{url('public/frontend/js/owl.carousel.js')}}"></script>
<script>
    $(document).ready(function() {
		var owl = $('.share_icon_slid .owl-carousel');
		owl.owlCarousel({
			margin: 0,
			nav: true,
			autoplay: false,
			loop: true,
			responsive: {
				0: {
					items: 5
				},
				350: {
					items: 6
				},
				415: {
					items: 7
				},
				480: {
					items: 5
				},
				520: {
					items: 6
				},
				768: {
					items: 5
				},
				991: {
					items: 6
				},
				1000: {
					items: 6
				}
			}
		})
	})

    channel.bind('call-extend-event', function(data) {
        console.log(data.time);
        var conversionId = data.conversation_id;
        auth_id='{{auth()->user()->id}}';
        console.log(auth_id)
        console.log(data.to_id);
        console.log(jQuery.inArray(parseInt(auth_id), data.to_id));
        console.log($('#conversation_id').val());
        if(jQuery.inArray(auth_id, data.to_id) !== -1 && conversionId==$('#conversation_id').val()){
            openCallExtend('F',data.time);
        }
    });
    var timerChange=0;
    localStorage.setItem('timerChange',timerChange);

    function startTimerForCall(){
        var counter = 60*1;
        var startTimeInterval2 = setInterval(function() {
            counter--;
            timerChange=parseInt(window.localStorage.getItem('timerChange'))
            // Display 'counter' wherever you want to display it.
            if (counter < 0 && timerChange==0) {
                clearInterval(startTimeInterval2);
                checkTwoPersion();
                return;
            }else{
                console.log("Timer --> " + counter);
            }
        }, 1000);
    }
    function checkTwoPersion(){
        console.log(totarticipant);
        if(totarticipant==2){
            swal({
                // title: "New video call request",
                text: 'Currently there are two users only in the conversation. If you want you can discontinue the call now and will get full refund. Do You want to continue the call ?',

                icon: "info",
                dangerMode: true,
                buttons: true,
                buttons: {
                    default: {
                        text: "YES - Continue call",
                        value: "No",
                        className:"swal-button--cancel"
                    },
                    catch: {
                        text: "NO- disconnect call",
                        value: "yes",
                        className:"swal-button--danger"
                    },
                },
            })
            .then((willDelete) => {
                switch (willDelete) {
                    case "yes":
                    callEndForTwoPersion();
                    console.log('Yes');
                    break;
                    case "No":
                    console.log('No');
                    break;
                    default:
                    console.log('ignore');
                }
            });
        }
    }

    function callEndForTwoPersion(){
        var roomId='{{Request::segment(2)}}';
        var userId=authUserID;
        var reqData = {
            'jsonrpc' : '2.0',
            '_token' : '{{csrf_token()}}',
            'params' : {
                'roomId':roomId,
                'userId':userId,
            }
        };
        $.ajax({
            url: "{{ route('call.end.refund') }}",
            method: 'post',
            dataType: 'json',
            data: reqData,
            success: function(response){
                location.href="{{route('welcome')}}/upcoming-conversations";
                if(response.error){

                }else{
                }
            }, error: function(error) {
                console.log(error)
            }
        });

    }

    channel.bind('call-end-refund', function(data) {
        newmsg = data.message;
        var conversionId = data.conversation_id;
        auth_id='{{auth()->user()->id}}';
        console.log(auth_id)
        console.log(data.to_id);
        console.log(jQuery.inArray(auth_id, data.to_id));
        if(jQuery.inArray(auth_id, data.to_id) !== -1 && conversionId==$('#conversation_id').val()){
            CallEndMessage();
            localStorage.setItem('timerChange',1);
        }
    });

    function CallEndMessage(){
        swal({
            // title: "New video call request",
            text: `Call End`,
            icon: "info",
        })
        .then((willDelete) => {
            location.href="{{route('welcome')}}/upcoming-conversations";
        });
    }
</script>
@endpush
