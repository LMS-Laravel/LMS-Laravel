<template>

   <!-- DIRECT CHAT PRIMARY -->
    <div class="card card-primary cardutline direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">Chat</h3>
            <div class="card-tools">
                <span data-toggle="tooltip" title="users connected" class="badge bg-primary">{{ users.length }} <i class="fa fas fa-users"></i></span>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" >
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" style="height: 440px; overflow-y:scroll" v-chat-scroll>
                <!-- Message. Default to the left -->
                <div v-for="(message, index) in messages" :key="index" class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">{{ message.user.name }}</span>
                        <!--<span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>-->
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="https://www.gravatar.com/avatar/e7f4690c8e8b9584f87de275bd669d8e.jpg?s=80&d=mm&r=g" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{ message.message }}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
            </div>
            <!--/.direct-chat-messages-->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

            <input type="text" v-model="newMessage" @keydown="sendTypingEvent" @keyup.enter="sendMessage" name="message" placeholder="Enter your message" class="form-control">
            <span class="text-muted" v-if="activeUser">{{ activeUser.name}} is typing...</span>
        </div>
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->


</template>

<script>
    export default {
        props:['user'],
        data() {
            return {
                messages: '',
                newMessage:'',
                activeUser:false,
                typingTimer: false,
                left:true,
                users:[],
            }
        },
        created() {
            this.fetchMessages();
            Echo.join('chat')
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user=> {
                    this.users = this.users.filter(u => u.id !== user.id);
                })
                .listen('MessageSent', (event) => {
                    this.messages.push(event.message);
                })
                .listenForWhisper('typing', user => {
                    this.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                    this.typingTimer = setTimeout(() => {
                        this.activeUser = false;
                    }, 3000)
                });

        },
        methods: {
            fetchMessages(){
                axios.get('api/message').then(response => {
                    this.messages = response.data;
                })
            },
            sendMessage(){
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('api/message', {message: this.newMessage});

                this.newMessage = '';
            },
            sendTypingEvent(){
                Echo.join('chat').whisper('typing', this.user);
            }
        }
    }
</script>
