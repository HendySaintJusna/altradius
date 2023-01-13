<template>

    <div>

        <div class="row justify-content-center">

            <div class="col-md-6" style="text-align: center;">
                <h2 style="font-family: 'Poppins', sans-serif;font-weight: 700">Explainations</h2>
                <h4 style="font-family: 'Poppins', sans-serif;">{{word}} {{slide}} - 3</h4>


                <div style="margin-top: 100px;" v-if="slide == 1">
                    <p style="font-size: 15px;"><i class="far fa-bell" style="font-size: 21px;"></i> - The place where you will accept the endorsement requests.</p>
                    <p style="font-size: 15px;margin-top: 46px;"><i style="font-size: 29px;" class="fab fa-twitter"></i>
                    - Redirect you to the user twitter page.</p>
                    <p style="font-size: 15px;margin-top: 46px;"><i style="font-size: 26px;" class="far fa-copy"></i> - Copy your portfolio link to share.</p>
                    <p style="margin-top: 35px;"><img style="height: 18px;
                    margin-top:0px;" src="/files/img/followers.png"> - The sum of your followers and those of your partners.</p>
                </div>
                

                <div style="margin-top: 100px;" v-if="slide == 2">
                    <p style="font-size: 15px;">To endorse a project, you must click on the icon <i class="fas fa-user-plus"></i> in the <span style="text-decoration:underline;">Partnerships section of their page</span> and wait for them to accept the request. Once accepted, you will appear in their portfolio as one of their supporters.</p>  
                </div>

                <div style="margin-top: 100px;" v-if="slide == 3">
                    <p style="font-size: 15px;">To get started, send your portfolio link to creators or influencers in the Twitter crypto community to invite them to endorse you. You will then be ready to share your portfolio on your bio.</p>  
                </div>

                <div class="form-group" style="margin-top: 48px;margin-bottom: 50px;" v-if="slide <= 2">
                  <a class="btn btn-primary w-100" href="#" role="button" @click.prevent="Next">Next</a>
                </div>
                <div class="form-group" style="margin-top: 48px;" v-if="slide == 3">
                  <a class="btn btn-primary w-100" href="#" role="button" @click.prevent="Finish">Finish</a>
                </div>
                <div class="form-group" style="margin-top: 20px;" v-if="slide == 2 || slide == 3">
                  <a class="btn btn-light w-100" href="#" role="button" @click.prevent="Back">Back</a>
                </div>


            </div>

        </div>

    </div>

</template>

<script>


    export default {


        data(){
            return {

                slide:1,
                word:"Icons"
                
            }
        },


        methods:{

            Next(){

                if (this.slide<4) {
                    this.slide += 1
                    this.TheTitle()
                }
                
            },

            TheTitle(){
                if (this.slide == 1) {
                    this.word = "Icons"
                } else if(this.slide == 2){
                    this.word = "How to endorse"
                } else if(this.slide == 3){
                    this.word = "How to get endorse"
                }
            },

            Back(){
                if (this.slide>0) {
                    this.slide -= 1
                    this.TheTitle()
                }
            },

            Finish(){

                // axios({
                //   method: "get",
                //   url: "/explaination/finish/",
                // })
                //   .then(function (response) {
                //     console.log(response.data)
                //   })
                //   .catch(function (error) {
                //     // handle error
                //     console.log(error);
                //   })
                //   .then(function () {
                //     // always executed
                //   });

                window.location = '/explaination/finish'
            },
           
        },


        created(){



        },

        mounted() {

        }
    }
</script>
