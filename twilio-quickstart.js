'use strict';

const Video = Twilio.Video;


var activeRoom;
var previewTracks;
var identity;
var roomName;
var totalParticipant=0;
var tokenUrl = 'get-twilio-token';

// Attach the Track to the DOM.
function attachTrack(track, container) {
    container.appendChild(track.attach());
    var video = container.getElementsByTagName("video")[0];
    if (video) {
        // video.setAttribute("style", "max-width:300px;");
    }
}

// Attach array of Tracks to the DOM.
function attachTracks(tracks, container) {
  tracks.forEach(function(track) {
    attachTrack(track, container);
  });
}

// Detach given track from the DOM
function detachTrack(track) {
  track.detach().forEach(function(element) {
    element.remove();
  });
}

// A new RemoteTrack was published to the Room.
function trackPublished(publication, container) {
  if (publication.isSubscribed) {
    attachTrack(publication.track, container);
  }
  publication.on('subscribed', function(track) {
    attachTrack(track, container);
  });
  publication.on('unsubscribed', detachTrack);
}

// A RemoteTrack was unpublished from the Room.
function trackUnpublished(publication) {
  log(publication.kind + ' track was unpublished.');
}

// A new RemoteParticipant joined the Room
function participantConnected(participant, container) {

    console.log('Participant "%s" connected', participant.identity.replace(/ /g, ""));
    var element = document.getElementById("media-div");
    var child=document.getElementById(participant.identity.replace(/ /g, ""));
    console.log(participant);
    if(child!=null){
        element.removeChild(child);
        totalParticipant=totalParticipant-1;
    }
    console.log(participant);

    const div = document.createElement('div');
    const div2 = document.createElement('div');
    const div1 = document.createElement('div');
    // div.id = participant.sid;
    div.id = participant.identity.replace(/ /g, "");
    // div.setAttribute("style", "float: left; margin: 10px;");
    const userName = `${participant.identity}`;
    const lastIndex = userName.lastIndexOf('-');

    const beforeIDVal = userName.slice(0, lastIndex);
    const isAnonymouslyLastIndex = beforeIDVal.lastIndexOf('--');

    const afterAnonymously = beforeIDVal.slice(isAnonymouslyLastIndex + 1);
    const beforeID = beforeIDVal.slice(0, isAnonymouslyLastIndex);

    const afterID = userName.slice(lastIndex + 1);

    div.classList.add("users_cont");
    div2.classList.add("use_vi_info");
    div1.classList.add("new_video_box");
    div1.id = participant.identity.replace(/ /g, "")+'new_video_box';
    var publicProfile=homeUrl+'/public-profile/'+afterID;
    console.log(afterAnonymously);
    if(afterAnonymously=='Y'){
        var publicProfile='javascript:;';
    }
    var videoShow = '';
    var audioShow = '';
    participant.tracks.forEach(function(publication) {
        trackPublished(publication, div2);
        console.log(publication);
        if(publication.kind=='video' && publication.isTrackEnabled==true){
            videoShow= 'display:none';
        }
        if(publication.kind=='video' && publication.isTrackEnabled==false){
            div.classList.add("muteblur");
        }
        if(publication.kind=='audio' && publication.isTrackEnabled==true){
            audioShow= 'display:none';
        }
    });
    div1.innerHTML =`
    <div class="top_area_flex">
    <div class="user_name_div">
    <a href="javascript:;" ${afterAnonymously=='Y'?'': 'class="connectUserShow"'} data-connectId="${afterID}" style = "position: relative; z-index: 99;"><p><img src="../public/frontend/images/no-video-p.png" id= "video-mute-${participant.identity.replace(/ /g, "")}" style="${videoShow}"> <img src="../public/frontend/images/mute-voice-p.png" id="audio-mute-${participant.identity.replace(/ /g, "")}" style="${audioShow}">${beforeID}</p></a>
    </div>
    <div class='top_area_video'>
    <a href='javascript:;' class='remove eviction' data-id='${participant.sid}' data-roomId='${roomName}' data-userId='${afterID}' title='Ask to leave' ><img src='../public/frontend/images/eviction.png'></a>
    <a href='javascript:;' class='remove_eviction' data-id='${participant.sid}' data-roomId='${roomName}' data-userId='${afterID}' title='Remove ask to leave' style='display:none' ><img src='../public/frontend/images/unblock.png'></a>
    <a href='javascript:;' class='warning' data-id='${participant.sid}' data-roomId='${roomName}' data-userId='${afterID}' title='Alert Send user'><img src='../public/frontend/images/warning.png'></a>
    <a href='javascript:;' class='report' data-id='${participant.sid}' data-roomId='${roomName}' data-userId='${afterID}' title='Report Send user'><img src='../public/frontend/images/report.png'></a></div></div>`;

    // participant.tracks.forEach(function(publication) {
    //     trackPublished(publication, div2);
    //     console.log(publication);
    //     if(publication.kind=='video' && publication.isTrackEnabled==true){
    //         videoShow= 'display:none';
    //     }
    //     if(publication.kind=='video' && publication.isTrackEnabled==false){
    //         div.classList.add("muteblur");
    //     }
    //     if(publication.kind=='audio' && publication.isTrackEnabled==true){
    //         audioShow= 'display:none';
    //     }
    // });
    participant.on('trackPublished', function(publication) {
        trackPublished(publication, div2);
    });
    participant.on('trackUnpublished', trackUnpublished);
    document.getElementById('media-div').appendChild(div);
    document.getElementById(participant.identity.replace(/ /g, "")).appendChild(div1);
    document.getElementById(participant.identity.replace(/ /g, "")+'new_video_box').appendChild(div2);
    // document.getElementById(participant.identity.replace(/ /g, "")).appendChild(div2);
    const appP = document.createElement('div');


    // appP.innerHTML=`<a href="${publicProfile}" ${afterAnonymously=='Y'?'': 'target="_blank"'} ><p><img src="../public/frontend/images/no-video-p.png" id= "video-mute-${participant.identity.replace(/ /g, "")}" style="${videoShow}"> <img src="../public/frontend/images/mute-voice-p.png" id="audio-mute-${participant.identity.replace(/ /g, "")}" style="${audioShow}">${beforeID}</p></a>`;
    appP.innerHTML=``;
    document.getElementById(participant.identity.replace(/ /g, "")).append(appP);
    // removeButtonRemove();
    totalParticipant=totalParticipant+1;
    totalParticipantList(totalParticipant);
    checkReportAdded(afterID);
    checkEvictionAdded(afterID);
}

// Detach the Participant's Tracks from the DOM.
function detachParticipantTracks(participant) {
    var element = document.getElementById("media-div");
    var child=document.getElementById(participant.identity.replace(/ /g, ""));
    console.log(child);
    if(child!=null){
        element.removeChild(child);
    }
    var tracks = getTracks(participant);
    tracks.forEach(detachTrack);

}

// When we are about to transition away from this page, disconnect
// from the room, if joined.
window.addEventListener('beforeunload', leaveRoomIfJoined);

// Obtain a token from the server in order to connect to the Room.


// Get the Participant's Tracks.
function getTracks(participant) {
  return Array.from(participant.tracks.values()).filter(function(publication) {
    return publication.track;
  }).map(function(publication) {
    return publication.track;
  });
}

// Successfully connected!
function roomJoined(room) {
    //   start_timer();
    // room.on("dominantSpeakerChanged", (track,participant) => {
    //     // this.log(participant.identity + "Dominent speaker changed: " + track.kind);
    //     // console.log('Call')
    //     // window.alert("Domient speaker changed")
    //     // window.alert(track)
    //     // console.log("Dominent speaker identified")
    //     // var previewContainer = document.getElementById("dominent-speaker");
    //     // this.attachTracks([track], previewContainer);
    // });

    window.room = activeRoom = room;
    // Attach LocalParticipant's Tracks, if not already attached.

    var previewContainer = document.getElementById('media-div');
    const div = document.createElement('div');
    const div1 = document.createElement('div');
    const div2 = document.createElement('div');
    const identity =window.localStorage.getItem('identity');
    div.id =identity.replace(/ /g, "");
    div.classList.add("users_cont");
    div1.classList.add("new_video_box");
    div1.id =identity.replace(/ /g, "")+'new_video_box';
    div2.classList.add("use_vi_info");
    if (!previewContainer.querySelector('video')) {
        attachTracks(getTracks(room.localParticipant), div2);
    }
    div1.innerHTML =`
    <div class="top_area_flex">
    <div class="user_name_div">
    <p><img src="../public/frontend/images/no-video-p.png" id="video-mute-${identity.replace(/ /g, "")}" style="display:none"> <img src="../public/frontend/images/mute-voice-p.png" id="audio-mute-${identity.replace(/ /g, "")}" style="display:none">You</p>
    </div>
    <div class='top_area_video top_area_video_user'>
    <a href='javascript:;' class='leave_eviction' data-id=${room.sid} title='Leave From Call' style="display:none"><img src='../public/frontend/images/quit.png'></a>
    <a href='javascript:;' class='share openshare' title='Share'><img src='../public/frontend/images/share.png'></a></div>
    </div>`;
    document.getElementById('media-div').appendChild(div);
    document.getElementById(identity.replace(/ /g, "")).appendChild(div1);
    document.getElementById(identity.replace(/ /g, "")+'new_video_box').appendChild(div2);
    const appP = document.createElement('p');
    const userName = `${identity}`;
    const lastIndex = userName.lastIndexOf('-');

    const beforeID = userName.slice(0, lastIndex);

    const afterID = userName.slice(lastIndex + 1);
    appP.innerHTML=` `;
    // appP.innerHTML=` <img src="../public/frontend/images/no-video-p.png" id= "video-mute-${identity.replace(/ /g, "")}" style="display:none"> <img src="../public/frontend/images/mute-voice-p.png" id="audio-mute-${identity.replace(/ /g, "")}" style="display:none">  ${beforeID}`;
    // document.getElementById(identity.replace(/ /g, "")).append(appP);


    // Attach the Tracks of the Room's Participants.
    var remoteMediaContainer = document.getElementById('remote-media');
    room.participants.forEach(function(participant) {
        // $('#connecting').hide();
        // $('#media-div').show();
        participantConnected(participant, remoteMediaContainer);
    });
    room.on('dominantSpeakerChanged', participant => {
        console.log('The new dominant speaker in the Room is:', participant);
        handleSpeakerChange(participant);
    });

    room.on('trackEnabled', function(track, participant) {
        if(track.kind =='video'){
            $('#'+participant.identity.replace(/ /g, "")).removeClass('muteblur');
            $('#video-mute-'+participant.identity.replace(/ /g, "")).hide();
        }
        if(track.kind =='audio'){
            $('#remote-audio-mute').hide();
            $('#audio-mute-'+participant.identity.replace(/ /g, "")).hide();
        }
    });

  // mute audio and video for remote user
  room.on('trackDisabled', function(track, participant) {
    if(track.kind =='video'){
      $('#remote-video-mute').show();
      $('#'+participant.identity.replace(/ /g, "")).addClass('muteblur');
      $('#video-mute-'+participant.identity.replace(/ /g, "")).show();
    }
    if(track.kind =='audio'){
        console.log('mute'+participant.identity.replace(/ /g, ""))
        $('#audio-mute-'+participant.identity.replace(/ /g, "")).show();
      $('#remote-audio-mute').show();
    }
  });

  // When a Participant joins the Room, log the event.
  room.on('participantConnected', function(participant) {
    // $('#connecting').hide();
    // $('#local-media').show();
    participantConnected(participant, remoteMediaContainer);
  });

  // When a Participant leaves the Room, detach its Tracks.
  room.on('participantDisconnected', function(participant) {
    console.log(participant);
    var element = document.getElementById("media-div");
    var child=document.getElementById(participant.identity.replace(/ /g, ""));
    console.log(child);
    if(child!=null){
        element.removeChild(child);
        totalParticipant=totalParticipant-1;
    }

    const userName = `${participant.identity.replace(/ /g, "")}`;
    const lastIndex = userName.lastIndexOf('-');

    const beforeIDVal = userName.slice(0, lastIndex);
    const isAnonymouslyLastIndex = beforeIDVal.lastIndexOf('--');

    const afterAnonymously = beforeIDVal.slice(isAnonymouslyLastIndex + 1);
    const beforeID = beforeIDVal.slice(0, isAnonymouslyLastIndex);

    const afterID = userName.slice(lastIndex + 1);
    updateCallTime(afterID,roomName);

    totalParticipantList(totalParticipant);

    // detachParticipantTracks(participant);
    // call videoCloseFunCustomer for stop timer and remove localstorage()

  });

  // Once the LocalParticipant leaves the room, detach the Tracks
  // of all Participants, including that of the LocalParticipant.
  room.on('disconnected', function() {
    // returnHome();
    // if (previewTracks) {
    //   previewTracks.forEach(function(track) {
    //     track.stop();
    //   });
    //   previewTracks = null;
    // }
    console.log(room);
    // detachParticipantTracks(room.localParticipant);
    // room.participants.forEach(detachParticipantTracks);
    // activeRoom = null;


  });


  room.on('reconnecting', error => {
    assert.equal(room.state, 'reconnecting');
    if (error.code === 53001) {
      console.log('Reconnecting your signaling connection!', error.message);
    } else if (error.code === 53405) {
      console.log('Reconnecting your media connection!', error.message);
    }
    /* Update the application UI here */
  });


  room.on('reconnected', () => {
    assert.equal(room.state, 'connected');
    console.log('Reconnected your signaling and media connections!');
    /* Update the application UI here */
  });




  // video mute and audio mute
  var localParticipant = room.localParticipant;
  $('body').on('click', '#video-mute', function() {
    $('#local-video-mute').show();
    $(this).hide();
    $('#video-unmute').show();
    const identity =window.localStorage.getItem('identity');
    $('#video-mute-'+identity.replace(/ /g, "")).show();

    localParticipant.videoTracks.forEach(function (videoTrack) {
      videoTrack.track.disable();
    });
  })

  $('body').on('click', '#video-unmute', function() {
    $('#local-video-mute').hide();
    $(this).hide();
    $('#video-mute').show();
    const identity =window.localStorage.getItem('identity');
    $('#video-mute-'+identity.replace(/ /g, "")).hide();
    localParticipant.videoTracks.forEach(function (videoTrack) {
      videoTrack.track.enable();
    });
  })
  $('body').on('click', '#audio-mute', function() {
    $('#local-audio-mute').show();
    $(this).hide();
    $('#audio-unmute').show();
    const identity =window.localStorage.getItem('identity');
    $('#audio-mute-'+identity.replace(/ /g, "")).show();
    localParticipant.audioTracks.forEach(function (audioTrack) {
      audioTrack.track.disable();
    });
  })

  $('body').on('click', '#audio-unmute', function() {
    $('#local-audio-mute').hide();
    $(this).hide();
    $('#audio-mute').show();
    const identity =window.localStorage.getItem('identity');
    $('#audio-mute-'+identity.replace(/ /g, "")).hide();
    localParticipant.audioTracks.forEach(function (audioTrack) {
      audioTrack.track.enable();
    });
  })


//   $('body').on('click', '#button-leave', function() {
//       console.log(activeRoom);
//     activeRoom.disconnect();
//     $('#local-video-mute').hide();
//     $(this).hide();
//     $('#video-mute').show();
//     localParticipant.videoTracks.forEach(function (videoTrack) {
//       videoTrack.track.enable();
//     });
//     updateCallTime(authUserID,roomName);
//     callDisconnectConfirm();
//     // returnHome();
//   })
//   $('body').on('click', '.remove', function() {
//       var sid=$(this).data('id');
//       console.log(activeRoom);
//       console.log(sid);
//       // activeRoom.sid.disconnect();

//         // activeRoom.disconnect();
//         // $('#local-video-mute').hide();
//         // $(this).hide();
//         // $('#video-mute').show();
//         // localParticipant.videoTracks.forEach(function (videoTrack) {
//         //     videoTrack.track.enable();
//         // });
//   })


}


// Preview LocalParticipant's Tracks.


// Activity log.
function log(message) {

}

// Leave Room.
function leaveRoomIfJoined() {
  if (activeRoom) {
    // activeRoom.disconnect();
  }
}


function setLabelColor(label, color){
    if(label !== null){
        label.style.backgroundColor = color;
    }
}

function removeDominantSpeaker(){
    let speakerNameLabel;
    speakerNameLabel = document.getElementById(lastSpeakerSID);
    setLabelColor(speakerNameLabel, "#ebebeb"); //Default color
}

function assignDominantSpeaker(participant){
    let domSpeakerNameLabel;
    lastSpeakerSID = "N_"+participant.sid;
    domSpeakerNameLabel = document.getElementById(lastSpeakerSID);
    setLabelColor(domSpeakerNameLabel, "#b5e7a0"); //Green color
}
function handleSpeakerChange(participant){
    removeDominantSpeaker();
    if(participant!=null)
        assignDominantSpeaker(participant);
}


