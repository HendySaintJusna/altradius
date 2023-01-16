<template>
    <div>
        <div class="row justify-content-center">

            <div class="col-md-3" style="text-align: center;">

                <div class="">

                    <img :src="avatar.image" @click.prevent="go_to_sn()" style="height: 170px;width:170px;border-radius: 50%;cursor: pointer;">            
                    
                    <h3 @click.prevent="verifyInfo()" style="cursor: pointer;margin-top: 22px;font-family: 'News Cycle', sans-serif;font-weight:700;">{{user.name}}
                        <img v-if="user.social_network == 'Twitter'" style="height: 27px;margin-top: -9px;" src="/files/img/correct.png">
                    </h3>
                    
                    <h5 style="cursor: pointer;text-align: center;color: #bdbdbd;">Total Reach ≈ {{total_reach | sortNumber}} <img style="height: 18px;
                    margin-top: -1px;" src="/files/img/followers.png"></h5>

                    <div class="row">

                        <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6" @click.prevent="go_to_sn(user.social_network)">
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Facebook'" class="fab fa-facebook-square"></i>
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Twitter'" class="fab fa-twitter"></i>
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Linkedin'" class="fab fa-linkedin"></i>
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Instagram'" class="fab fa-instagram"></i>
                           <i style="font-size: 29px;cursor: pointer;margin-top: 5px;" v-if="user.social_network == 'Instagram-uncheck'" class="fab fa-instagram"></i>
                        </div>

                        <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                           <button v-clipboard="url.urlpage" class="btn btn-link" @click.prevent="share()" style="color:white;">
                                <!-- <div @click.prevent="share()"> -->
                                    <i style="font-size: 26px;cursor:pointer;" class="far fa-copy"></i>
                                    <!-- <i style="font-size: 26px;cursor:pointer;"  class="far fa-share-square"></i> -->
                                <!-- </div> -->
                              
                            </button>
                        </div>
                        
                    </div>

                </div>

            </div>

        </div>


        <div v-if="url.show"  style="margin-top: 18px;">
            <div class="row justify-content-center" style="">
                <h5 style="color:white;">Share this network:</h5>
            </div>
            <div class="row justify-content-center" style="">
                <h6 style="color:white;">{{url.urlpage}}</h6>
            </div>
            <qrcode-vue :value="qrvalue"></qrcode-vue>
        </div>


        <div class="row justify-content-center" style="margin-top: 35px;margin-bottom: 70px;">


            <div class="col-md-7" style="text-align: center;">


                <div>
                    <h4 style="font-family: 'News Cycle', sans-serif;">Partnerships</h4>
                    <!-- <p style="color:rgb(189, 189, 189);font-size: 13px;">My best connections.</p> -->
                </div>

                <div class="row justify-content-between">


                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member1.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member1.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member1.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member1.info.url_account)">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member2.info.url_account)">{{crew.member1.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
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
                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member2.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member2.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member2.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member2.info.url_account)">
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
                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member3.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member3.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member3.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member3.info.url_account)">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member2.info.url_account)">{{crew.member3.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
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
               <!--      <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member4.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member4.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member4.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member4.info.url_account)">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member4.info.url_account)">{{crew.member4.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member4.info.url_account)">{{crew.member4.info.logline}}</p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member5.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member5.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member5.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member5.info.url_account)">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member2.info.url_account)">{{crew.member5.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
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

                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member6.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member6.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member6.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member6.info.url_account)">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member2.info.url_account)">{{crew.member6.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
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
                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member7.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member7.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member7.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member7.info.url_account)">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member2.info.url_account)">{{crew.member7.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
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
                  <!--   <div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3">
                        <div class="row justify-content-center">
                            <div @click.prevent="addInCrew()" v-if="crew.member8.info == ''" class="cercle-member-empty">
                                <div  class="image-default">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div v-if="crew.member8.info !== ''">
                                <div class="cercle-member-not-empty">
                                    <img :src="imageMembers(crew.member8.info.avatar)" class="image-member" @click.prevent="go_to_profile(crew.member8.info.url_account)">
                                </div>
                                <h6 style="margin-top: 0px;" @click.prevent="go_to_profile(crew.member8.info.url_account)">{{crew.member8.info.name}} <img v-if="user.social_network !== 'Instagram-uncheck'" style="height: 14px;margin-top: -3px;" src="/files/img/correct.png" @click.prevent="verifyInfo()"></h6>
                                <p class="logline-members" @click.prevent="go_to_profile(crew.member8.info.url_account)">{{crew.member8.info.logline}}</p>
                            </div>
                        </div>
                    </div> -->

            
                </div>

            </div>

        </div>
        


    </div>
</template>

<script>
    
    import Notiflix from "notiflix";
    // import QrcodeVue from 'qrcode.vue'

    export default {

        props:{

            target:{
                type:Array,
                required:true
            },

            connected:{
                type:String,
                required:true
            },

            members:{
                type:Array,
                required:true   
            }
            
        },

        // components: {
        //     QrcodeVue,
        // },

        data(){
            return {

                user:this.target[0],
                sn:'',
                // qrvalue:'',

                url:{
                    urlpage:'',
                    show:false
                },

                avatar:{
                    image:"",
                    upload_image:"",
                    show_upload_avatar:false,
                },

                total_reach:0,

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
                    member5:{
                        info:""
                    },
                    member6:{
                        info:""
                    },
                    member7:{
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

            verifyInfo(){
                if (this.user.social_network == 'Instagram-uncheck') {
                    Notiflix.Notify.warning('This user is not verified');
                } else {
                    Notiflix.Notify.success('This user is verified');
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

            share(){
                // this.url.show = !(this.url.show)
                Notiflix.Notify.success('Link copied!');
            },

            imageMembers(name){
                console.log(name)
                if (name == 'null') {
                    return '/files/img/user.png'
                }
                return '/files/img/avatar/'+name
            },

            addInCrew(){

                if (parseInt(this.connected)) {

                    var vm = this

                    axios({
                      method: "post",
                      url: "/invitation/"+vm.user.url_account,
                    })
                      .then(function (response) {

                       if (response.data == 'member') {
                            Notiflix.Notify.info('You are already display in this portfolio.');
                       }else if(response.data == 'pending'){
                            Notiflix.Notify.info('Your request is pending.');
                       }else if(response.data == 'blocked'){
                            Notiflix.Notify.failure('Unfortunately, this person does not want to endorse you.');
                       }else if(response.data == 'self'){
                            Notiflix.Report.info('Partership','By clicking this case, Twitter influencers/brands can make a request to be display in your portfolio as one of your partnership.','Ok');
                       }else{

                            Notiflix.Report.success(
                                'Your request is sent!',
                                'Your request to be listed in this portfolio is pending at this time. Please wait for the user\'s response.',
                                'Ok'
                            );

                       }



                      })
                      .catch(function (error) {
                        // handle error
                        console.log(error);
                      })
                      .then(function () {
                        // always executed
                      });


                } else {
                    window.location = '/sign-in/from/'+this.user.url_account
                }


            },


            sortMember(x){

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

            this.url.urlpage = 'https://www.altradius.com/'+this.user.url_account
            // this.url.qrvalue = 'https://www.creworth.com/'+this.user.url_account

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
                this.logline.logline='No description yet.'
            } else {
                this.logline.logline=this.user.logline
            }


        },

        mounted() {

        }
    }
</script>
