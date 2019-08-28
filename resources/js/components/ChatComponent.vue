<template>

   <!-- DIRECT CHAT PRIMARY -->
    <div class="card card-primary cardutline direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">Chat</h3>
            <div class="card-tools">
                <span data-toggle="tooltip" title="users connected" class="badge bg-primary">{{ users.length }} <i class="fa fas fa-users"></i></span>
                <span data-toggle="tooltip" v-on:click="changeVolumen" title="volume" class="badge bg-primary">
                    <i v-if="muted" class="fa fas fa-volume-off"></i>
                    <i v-else class="fa fas fa-volume-up"></i>
                </span>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" >
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" style="height: 359px; overflow-y:scroll" v-chat-scroll>
                <!-- Message. Default to the left -->
                <div v-for="(message, index) in messages" :key="index" class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">{{ message.user.name }}</span>
                        <span class="direct-chat-timestamp float-right">{{ parseDate(message.created_at) }}</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" v-bind:style= "[isActiveUser(message.user) ? { 'border-style': 'solid', 'border-color':'green' } : { 'border-style': 'solid', 'border-color':'red' }]" src="https://www.gravatar.com/avatar/e7f4690c8e8b9584f87de275bd669d8e.jpg?s=80&d=mm&r=g" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text" v-html=render.shortnameToImage(message.message) v-bind:style= "[isAdmin(message.user) ? { 'background': '#007bff', 'color':'black'} : '']">
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <span class="text-muted" v-if="activeUser">{{ activeUser.name}} is typing...</span>
                <!-- /.direct-chat-msg -->
            </div>
            <!--/.direct-chat-messages-->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

            <textarea type="text" v-model="newMessage" ref="message" @keyup.enter="sendMessage" name="message" placeholder="¿Que estas pensando?" class="form-control"></textarea>
        </div>
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->


</template>

<script>
    import toolkit from 'emoji-toolkit';
    import moment  from 'moment';

    export default {
        props:['user', 'resource', 'type'],
        data() {
            return {
                messages: '',
                newMessage:'',
                activeUser:false,
                typingTimer: false,
                left:true,
                users:[],
                sound: 'sms.mp3',
                render: toolkit,
                muted: false,
                routeApi:  '/api/message',
                chatName: 'chat'
            }
        },
        created() {
            this.fetchMessages();
            this.makeNameChat();
            Echo.join(this.chatName)
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    if(this.users.filter(u => u.id !== user.id).length){
                        this.users.push(user);
                    }
                })
                .leaving(user=> {
                    this.users = this.users.filter(u => u.id !== user.id);
                })
                .listen('MessageSent', (event) => {
                    this.messages.push(event.message);
                    if(!this.muted){
                        let audio = new Audio(this.sound);
                        audio.play();
                    }
                })
                .listenForWhisper('typing', user => {
                    this.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                    this.typingTimer = setTimeout(() => {
                        this.activeUser = false;
                    }, 2000)
                });

        },
        mounted(){
            var self = this;
            var element = this.$refs['message'];
            $(element).emojioneArea({
                pickerPosition: "top",
                tonesStyle: "bullet",
                autocomplete: true,
                shortnames: true,
                saveEmojisAs: "shortname",
                events: {
                    keyup: function (editor, event){
                         if(event.keyCode === 13){
                             self.newMessage = this.getText();
                             self.sendMessage();
                             editor[0].textContent = '';
                         }
                    },
                    keydown: function(){
                        self.sendTypingEvent();
                    }
                }
            });
        },
        methods: {
            fetchMessages(){
                this.makeUrlApi();
                axios.get(this.routeApi).then(response => {
                    this.messages = response.data;
                })
            },
            sendMessage(){
                this.messages.push({
                    user: this.user,
                    message: this.ucFirst(this.newMessage)
                });
                this.makeUrlApi();
                axios.post(this.routeApi, {
                    message: this.ucFirst(this.newMessage),
                    resource: this.resource,
                    type: this.type
                });
                this.newMessage = '';
            },
            sendTypingEvent(){
                Echo.join(this.chatName).whisper('typing', this.user);
            },
            isActiveUser(user){
                return this.users.filter(u => u.id === user.id).length;
            },
            isAdmin(user){
                return user.id === 1;
            },
            ucFirst(string)
            {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            changeVolumen(){
                if(this.muted){
                    this.muted = false;
                    return true;
                }
                this.muted = true;
            },
            parseDate(date){
                if(date){
                    return moment(date, "YYYY-MM-DD hh:mm:ss").locale('es').fromNow();
                } else {
                    var now = moment().subtract(1, 'seconds');
                    return moment(now).locale('es').fromNow();
                }
            },
            makeUrlApi(){
                if(this.type !== 'stream'){
                    this.routeApi += "?resource="+this.resource+"&type=" + this.type;
                }
            },
            makeNameChat(){
                this.chatName += '-' + this.resource;
            }
        },
    }
</script>
