<template>
    <div>
        <div class="row justify-content-center">

            <div class="col-md-3" style="text-align: center;">

                <div class="">

                    <img :src="avatar.image" @click.prevent="showUploadAvatar()" style="height: 170px;width:170px;border-radius: 50%;cursor: pointer;">

                    <div v-if="avatar.show_upload_avatar">
                        <input type="file" id="upload" v-on:change="setImage" hidden/>
                        <label for="upload">Choose file (jpg,png,gif)</label>
                    </div>
                    
                    <!-- <img :src="sn" style="height: 28px;margin-top: -5px;"> -->
                    <h3 style="cursor: pointer;margin-top: 22px;font-family: 'News Cycle', sans-serif;font-weight:700;">{{user.name}}                        
                        <img v-if="user.social_network == 'Twitter'" style="height: 27px;margin-top: -9px;" src="/files/img/correct.png">
                    </h3>
                    
                    <h5 style="cursor: pointer;text-align: center;margin-top: 12px;margin-bottom: 11px;color: #bdbdbd;">Total Reach ≈ {{total_reach | sortNumber}} <img style="height: 18px;
                    margin-top: -6px;" src="/files/img/followers.png"></h5>

                    <div class="row">

                        <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                           <p style="font-size: 26px;cursor:pointer;" @click.prevent="showNotifications()"><span style="margin-right: 5px;color: #ababab;">{{notifications.data.length}}</span><i class="far fa-bell"></i></p>
                        </div>

                        <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4" @click.prevent="go_to_sn()">
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Facebook'" class="fab fa-facebook-square"></i> 
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Twitter'" class="fab fa-twitter"></i>
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Linkedin'" class="fab fa-linkedin"></i>
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Instagram'" class="fab fa-instagram"></i>
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Instagram-uncheck'" class="fab fa-instagram"></i>
                        </div>

                        <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <button v-clipboard="url.urlpage" class="btn btn-link" @click.prevent="share()" style="color:white;">
                                <!-- <div @click.prevent="share()"> -->
                                    <i style="font-size: 26px;cursor:pointer;margin-top: -3px;" class="far fa-copy"></i>
                                    <!-- <i style="font-size: 26px;cursor:pointer;margin-top: -3px;"  class="far fa-share-square"></i> -->
                                <!-- </div> -->
                              
                            </button>
                        </div>
                        
                    </div>
                    
                </div>

            </div>

        </div>


        <div v-if="url.show"  style="margin-top: 18px;">
            <div class="row justify-content-center" style="">
                <h5 style="color:white;">Share this project:</h5>
            </div>
            <div class="row justify-content-center" style="">
                <h6 style="color:white;">{{url.urlpage}}</h6>
            </div>
        </div>

        <div v-if="notifications.show" class="row justify-content-center" style="margin-top: 35px;">
            <div class="col-md-7" v-if="notifications.data.length>0" style="text-align:center;">
                <div v-for="arr in notifications.data">
                    <div class="row">
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p><a href="#" @click.prevent="go_to_profile(JSON.parse(arr.userdata)[0].url_account)">{{JSON.parse(arr.userdata)[0].name}}</a> would like to make your partnership public.</p>
                        </div>
                        <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <button class="btn btn-success" @click.prevent="acceptRequest(JSON.parse(arr.userdata)[0].id)"><i class="fas fa-check"></i></button>
                        </div>
                        <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <button class="btn btn-danger" @click.prevent="refuseRequest(JSON.parse(arr.userdata)[0].id)"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-7" v-if="notifications.data.length==0" style="text-align:center;">
                <div>
                    No notifications
                </div>
            </div>
        </div>


        <div class="row justify-content-center" style="margin-top: 35px;margin-bottom: 70px;">


            <div class="col-md-7" style="text-align: center;">

                <div>
                    <h4 style="font-family: 'News Cycle', sans-serif;">Partnerships</h4>
                    <!-- <p style="color:rgb(189, 189, 189);">Share your link <i style="color:white;margin-left: 3px;"  class="far fa-share-square"></i> everywhere to show your connections. Invite new members by sending them this link so they can apply <i class="fas fa-user-plus" style="color:white;"></i> to join your network.</p> -->
                </div>


                <div class="row justify-content-between">
                    
                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4" name="member-1">
                        <div class="row justify-content-center">
                            <div v-if="crew.member1.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member1.info !== ''" @click.prevent="go_to_profile(crew.member1.info.url_account)">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member1.info.avatar)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member1.info.url_account)">{{crew.member1.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member1.info.url_account)">Reach ≈ {{crew.member1.info.followers | sortNumber}} <img style="height: 12px;
                    margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div v-if="crew.member1.info == ''" style="margin-top: 13px;">
                            <h6 @click.prevent="go_to_profile(crew.member1.info.url_account)">Join</h6>
                            <p class="logline-members">Reach ≈ 0 <img style="height: 12px;
                            margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4" name="member-2">
                        <div class="row justify-content-center">
                            <div v-if="crew.member2.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member2.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member2.info.avatar)" @click.prevent="go_to_profile(crew.member2.info.url_account)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member2.info.url_account)">{{crew.member2.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member1.info.url_account)">Reach ≈ {{crew.member1.info.followers | sortNumber}} <img style="height: 12px;
                    margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div v-if="crew.member2.info == ''" style="margin-top: 13px;">
                            <h6 @click.prevent="go_to_profile(crew.member1.info.url_account)">Join</h6>
                            <p class="logline-members">Reach ≈ 0 <img style="height: 12px;
                            margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4" name="member-3">
                        <div class="row justify-content-center">
                            <div v-if="crew.member3.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member3.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member3.info.avatar)" @click.prevent="go_to_profile(crew.member3.info.url_account)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member3.info.url_account)">{{crew.member3.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member1.info.url_account)">Reach ≈ {{crew.member1.info.followers | sortNumber}} <img style="height: 12px;
                    margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div v-if="crew.member3.info == ''" style="margin-top: 13px;">
                            <h6 @click.prevent="go_to_profile(crew.member1.info.url_account)">Join</h6>
                            <p class="logline-members">Reach ≈ 0 <img style="height: 12px;
                            margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3" name="member-4">
                        <div class="row justify-content-center">
                            <div v-if="crew.member4.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member4.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member4.info.avatar)" @click.prevent="go_to_profile(crew.member4.info.url_account)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member4.info.url_account)">{{crew.member4.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member4.info.url_account)">{{crew.member4.info.logline}}</p>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4" name="member-5">
                        <div class="row justify-content-center">
                            <div v-if="crew.member5.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member5.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member5.info.avatar)" @click.prevent="go_to_profile(crew.member5.info.url_account)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member5.info.url_account)">{{crew.member5.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member1.info.url_account)">Reach ≈ {{crew.member1.info.followers | sortNumber}} <img style="height: 12px;
                    margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div v-if="crew.member5.info == ''" style="margin-top: 13px;">
                            <h6 @click.prevent="go_to_profile(crew.member1.info.url_account)">Join</h6>
                            <p class="logline-members">Reach ≈ 0 <img style="height: 12px;
                            margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4" name="member-6">
                        <div class="row justify-content-center">
                            <div v-if="crew.member6.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member6.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member6.info.avatar)" @click.prevent="go_to_profile(crew.member6.info.url_account)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member6.info.url_account)">{{crew.member6.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member1.info.url_account)">Reach ≈ {{crew.member1.info.followers | sortNumber}} <img style="height: 12px;
                    margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div v-if="crew.member6.info == ''" style="margin-top: 13px;">
                            <h6 @click.prevent="go_to_profile(crew.member1.info.url_account)">Join</h6>
                            <p class="logline-members">Reach ≈ 0 <img style="height: 12px;
                            margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4" name="member-7">
                        <div class="row justify-content-center">
                            <div v-if="crew.member7.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member7.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member7.info.avatar)" @click.prevent="go_to_profile(crew.member7.info.url_account)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member7.info.url_account)">{{crew.member7.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member1.info.url_account)">Reach ≈ {{crew.member1.info.followers | sortNumber}} <img style="height: 12px;
                    margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div v-if="crew.member7.info == ''" style="margin-top: 13px;">
                            <h6 @click.prevent="go_to_profile(crew.member1.info.url_account)">Join</h6>
                            <p class="logline-members">Reach ≈ 0 <img style="height: 12px;
                            margin-top: -3px;" src="/files/img/followers.png"></p>
                            </div>
                        </div>
                    </div>

                   <!--  <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3" name="member-8">
                        <div class="row justify-content-center">
                            <div v-if="crew.member8.info == ''" class="cercle-member-empty" @click.prevent="infoShare()">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member8.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member8.info.avatar)" @click.prevent="go_to_profile(crew.member8.info.url_account)" class="image-member">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member8.info.url_account)">{{crew.member8.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member8.info.url_account)">{{crew.member8.info.logline}}</p>
                            </div>
                        </div>
                    </div>
 -->


                </div>


                



            </div>

        </div>



    </div>
</template>

<script>

    import Notiflix from "notiflix";

    export default {

        props:{

            target:{
                type:Array,
                required:true
            },

            noti:{
                type:Array,
                required:true
            },
            
            members:{
                type:Array,
                required:true   
            }
            
        },

        data(){
            return {

                user:this.target[0],
                sn:'',


                url:{
                    urlpage:'',
                    show:false
                },

                notifications:{
                    show:false,
                    data:""
                },

                total_reach:0,


                avatar:{
                    image:"",
                    upload_image:"",
                    show_upload_avatar:false,
                },

                crew:{
                    member1:{
                        info:""
                    },
                    member2:{
                        info:""
                    },
                    member3:{
                        info:""
                    },
                    member4:{
                        info:""
                    },
                    member5:{
                        info:""
                    },
                    member6:{
                        info:""
                    },
                    member7:{
                        info:""
                    },
                    member8:{
                        info:""
                    },
                },


                logline:{
                    logline:'',
                    new_logline:'',
                    change_logline:false,
                }
                
            }
        },


        methods:{

            share(){
                // this.url.show = !(this.url.show)
                Notiflix.Notify.success('Link copied!');
            },


            verifyInfo(){
                if (this.user.social_network == 'Instagram-uncheck') {
                    Notiflix.Report.info('Be verified','To be verified, you will have to tag our page @mycreworth on one of your Instagram post. Afterwards, your account will be verified within 24 hours.','Ok');
                } else {
                    Notiflix.Notify.success('You are verified');
                }
            },

            clipboardSuccessHandler ({ value, event }) {
              console.log('success', value)
            },
         
            clipboardErrorHandler ({ value, event }) {
              console.log('error', value)
            },

            go_to_profile (url) {
              window.location = '/'+url
            },

            social_network_logo(x){
                if (x == 'Facebook') {
                    return '/files/img/facebook.png'
                } else if(x == 'Twitter'){
                    return '/files/img/twitter.png'
                } else if(x == 'Linkedin'){
                    return '/files/img/linkedin.png'
                }
            },

            imageMembers(name){
                console.log(name)
                if (name == 'null') {
                    return '/files/img/user.png'
                }
                return '/files/img/avatar/'+name
            },

            go_to_sn(){
                if (this.user.social_network == 'Twitter') {
                    window.open('https://twitter.com/'+this.user.name)
                }else if(this.user.social_network == 'Facebook'){
                    window.open('https://www.facebook.com/search/top?q='+this.user.name)
                }else if(this.user.social_network == 'Instagram' || this.user.social_network == 'Instagram-uncheck'){
                    window.open('https://www.instagram.com/'+this.user.name)
                }else{
                    window.open('https://www.linkedin.com/search/results/all/?keywords='+this.user.name)
                }
            },

            changeLogline(){
                this.logline.change_logline = !(this.logline.change_logline)
            },

            showNotifications(){
                console.log('tt')
                this.notifications.show = !(this.notifications.show)
            },

            infoShare(){

                Notiflix.Report.info('Partnerships','By clicking this case, Twitter influencers/brands can make a request to be display in your portfolio as one of your partnership.','Ok');

            },

            setImage(e) {

                var vm = this

                if (e.target.files[0].type == 'image/heif' || e.target.files[0].type == 'image/webp' || e.target.files[0].type == 'image/bmp' || e.target.files[0].type == 'image/gif' || e.target.files[0].type == 'image/png' || e.target.files[0].type == 'image/jpeg' || e.target.files[0].type == 'image/jpg' || e.target.files[0].type == 'image/heic') {

                    this.avatar.upload_image = e.target.files[0]

                    var formData = new FormData()
                    formData.append('avatar', this.avatar.upload_image)
                    Notiflix.Loading.standard();

                    axios({
                      method: "post",
                      url: "/update/avatar",
                      data: formData,
                      headers: { "Content-Type": "multipart/form-data" },
                    })
                      .then(function (response) {

                        Notiflix.Loading.remove();
                        Notiflix.Notify.success('Your avatar is saved.');
                        vm.avatar.image = response.data
                        vm.showUploadAvatar()

                      })
                      .catch(function (error) {
                        // handle error
                        console.log(error);
                      })
                      .then(function () {
                        // always executed
                      });

                } else {
                    Notiflix.Notify.failure('Add an image as avatar.');
                }

            },

            showUploadAvatar(){
                this.avatar.show_upload_avatar = !(this.avatar.show_upload_avatar)
            },


            acceptRequest(id){
                var vm =this
                axios({
                  method: "post",
                  url: "/add/member/"+id,
                })
                  .then(function (response) {

                    if (response.data == 'full') {

                        Notiflix.Report.info('Portfolio full','Your portfolio exceeds the maximum of 6 members. Please remove old parterships to add new ones.','Ok');

                    } else {

                        vm.notifications.data = (response.data)[0]
                        var new_members = (response.data)[1]
                        vm.emptyMembers()
                        new_members.forEach(function(arr) {
                            vm.sortMember(JSON.parse(arr.userdata)[0]);
                        });
                        Notiflix.Notify.success('This partner is accepted to your portfolio!');

                    }



                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .then(function () {
                    // always executed
                  });

            },

            refuseRequest(id){
                var vm =this
                axios({
                  method: "post",
                  url: "/refuse/member/"+id,
                })
                  .then(function (response) {

                    vm.notifications.data = response.data
                    console.log(response.data)
                    Notiflix.Notify.failure('User refused.');


                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .then(function () {
                    // always executed
                  });

            },


            loglineUpdate(){

                var vm = this

                if (this.logline.new_logline != '') {

                    var formData = new FormData()
                    formData.append('logline', vm.logline.new_logline)

                    axios({
                      method: "post",
                      url: "/change/logline",
                      data: formData,
                      headers: { "Content-Type": "multipart/form-data" },
                    })
                      .then(function (response) {

                        Notiflix.Notify.success('Your description is saved.');
                        vm.logline.logline = vm.logline.new_logline
                        vm.changeLogline()

                      })
                      .catch(function (error) {
                        // handle error
                        console.log(error);
                      })
                      .then(function () {
                        // always executed
                      });

                } else {

                    // Notiflix.Notify.failure('Please, write a description in the field.');
                    vm.changeLogline()
                }
            },

    

            sortMemberPremium(x){

                if (this.crew.member1.info == "") {
                    this.crew.member1.info = x
                }else if(this.crew.member2.info == ""){
                    this.crew.member2.info = x
                }else if(this.crew.member3.info == ""){
                    this.crew.member3.info = x
                }else if(this.crew.member4.info == ""){
                    this.crew.member4.info = x
                }else if(this.crew.member5.info == ""){
                    this.crew.member5.info = x
                }else if(this.crew.member6.info == ""){
                    this.crew.member6.info = x
                }else if(this.crew.member7.info == ""){
                    this.crew.member7.info = x
                }else if(this.crew.member8.info == ""){
                    this.crew.member8.info = x
                }   

            },

            sortMember(x){

                if (this.crew.member1.info == "") {
                    this.crew.member1.info = x
                }else if(this.crew.member2.info == ""){
                    this.crew.member2.info = x
                }else if(this.crew.member3.info == ""){
                    this.crew.member3.info = x
                }else if(this.crew.member5.info == ""){
                    this.crew.member5.info = x
                }else if(this.crew.member6.info == ""){
                    this.crew.member6.info = x
                }else if(this.crew.member7.info == ""){
                    this.crew.member7.info = x
                } 

            },


            emptyMembers(){
                this.crew.member1.info = ""
                this.crew.member2.info = ""
                this.crew.member3.info = ""
                this.crew.member5.info = ""
                this.crew.member6.info = ""
                this.crew.member7.info = ""
            },

            emptyMembersPremium(){
                this.crew.member1.info = ""
                this.crew.member2.info = ""
                this.crew.member3.info = ""
                this.crew.member4.info = ""
                this.crew.member5.info = ""
                this.crew.member6.info = ""
                this.crew.member7.info = ""
                this.crew.member8.info = ""
            },


        },

        filters: {
          
          sortNumber(x){
            if(x>999 && x<10000){
                return (x/1000).toFixed(1) + "k"
            }else if(x>9999 && x<100000){
                return (x/1000).toFixed(1) + "k"
            }else if(x>99999 && x<1000000){
                return Math.round(x/1000) + "k"
            }else if(x>999999){
                return (x/1000000).toFixed(1) + "M"
            }else{
                return x
            }
          }

        },


        created(){

            var vm = this
            var reach_total = 0

            this.members.forEach(function(arr) {
                vm.sortMember(JSON.parse(arr.userdata)[0]);
            });

            this.members.forEach(function(arr) {
                var reach = JSON.parse(arr.userdata)[0].followers
                reach_total += reach
            });

            this.total_reach = reach_total + this.user.followers

            this.notifications.data = this.noti

            this.url.urlpage = '/'+this.user.url_account

            if (this.user.avatar == 'null') {
                this.avatar.image='/files/img/user.png'
            } else {
                this.avatar.image='/files/img/avatar/'+this.user.avatar
            }

            if (this.user.social_network == 'Facebook') {
                this.sn='/files/img/facebook.png'
            } else {
                this.sn='/files/img/twitter.png'
            }

            if (this.user.logline == null) {
                this.logline.logline='Profession (20 Characters)'
            } else {
                this.logline.logline=this.user.logline
            }


        },

        mounted() {

        }
    }
</script>
