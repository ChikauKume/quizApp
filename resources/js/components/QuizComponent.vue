<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Online ExaminAction
                        <span class="float-right">{{questionIndex}}/{{questions.length}}</span>
                    </div>

                    <div class="card-body">
                        <span class="float-right" style="color:red;">{{ time }}</span>
                        <div v-for="(question,index) in questions" :key="index">
                            <div v-show="index===questionIndex">
                                {{ question.question }}
                                <ol>
                                    <li v-for="(choice, i) in question.answers" :key="i">
                                        <label>
                                            <input type="radio" 
                                            :value="choice.is_correct==true?true:choice.answer" 
                                            :name="index"
                                            v-model="userResponses[index]"
                                            @click="choices(question.id,choice.id)">
                                            {{ choice.answer}}
                                        </label>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div v-show="questionIndex!=questions.length">
                            <button v-if="questionIndex>0" class="btn btn-success float-left" @click="prev()">
                                Prev
                            </button>
                            <button class="btn btn-success float-right" @click="next(); postuserChoice();">
                                Next
                            </button> 
                        </div>
                        <div v-show="questionIndex==questions.length">
                            <p>
                                <center>You've got {{score()}}/{{questions.length}}</center>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   import moment from 'moment'

    export default {
        props:['quizid','quizQuestions','hasQuizPlayed','times'],
        data(){
            return {
                questions: this.quizQuestions,
                questionIndex: 0,
                userResponses:Array(this.quizQuestions.length).fill(false),
                currentQuestion:0,
                currentAnswer:0,
                clock: moment(this.times*60 * 1000),
            }
        }, 
        methods:{
            next(){
                this.questionIndex++;
            },
            prev(){
                if(this.questionIndex == 0){
                    this.questionIndex = 0;
                }
                else{
                    this.questionIndex--;
                }
            },
            choices(question, answer){
                this.currentAnswer = answer;
                this.currentQuestion = question;
            },
            score(){
                return this.userResponses.filter(
                    val => val === true
                ).length;
            },
            // postuserChoice(){
            //     axios.post('/quiz/create',{
            //         answerId: this.currentAnswer,
            //         questionId: this.currentQuestion,
            //         quizId: this.quizid,

            //     }).then((res) => {
            //         console.log(res);
            //     }).catch((err) => {
            //         alert("Error!!");
            //     })
            // },
            async postuserChoice(){
                try{
                    const res = await axios.post('/quiz/create',{
                        answerId: this.currentAnswer,
                        questionId: this.currentQuestion,
                        quizId: this.quizid,
                    });
                    console.log(res);
                }
                catch(err){
                    alert(err);
                }
            },
        },
        mounted(){
            // prohibit right click
            window.oncontextmenu = function() {
                console.log("Right Click Disabled");
                return false;
            },
            setInterval(() => {
                this.clock = moment(this.clock.subtract(1,'seconds'));
            },1000);
        },
        computed:{
            time:function(){
                let minsec = this.clock.format('mm:ss');
                if(minsec == '00:00'){
                    alert('Timeout!');
                    window.location.reload();
                }
                return minsec;
            }
        }
    }
</script>
