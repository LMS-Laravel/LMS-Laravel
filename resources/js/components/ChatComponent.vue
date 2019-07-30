<template>

    <div class="card card-default">
        <div class="card-header">Chat</div>
        <div class="card-body p-0">
            <ul class="list-unstyled" style="height: 440px; overflow-y:scroll" v-chat-scroll>
                <li class="p-2" v-for="(message, index) in messages" :key="index">
                    <strong>{{ message.user.name }}</strong>
                    {{ message.message }}
                </li>
            </ul>
        </div>
        <input type="text" v-model="newMessage" @keydown="sendTypingEvent" @keyup.enter="sendMessage" name="message" placeholder="Enter your message" class="form-control">
        <span class="text-muted" v-if="activeUser">{{ activeUser.name}} is typing...</span>
    </div>
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
            }
        },
        created() {
            this.fetchMessages();
            Echo.join('chat')
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
                axios.post('api/message', {message: this.newMessage})

                this.newMessage = '';
            },
            sendTypingEvent(){
                Echo.join('chat').whisper('typing', this.user);
            }
        }
    }
</script>
