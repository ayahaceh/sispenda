@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <label for="">Push Notification to Telegram Channel</label>
                        <button href="{{ url('/telegram/send-photo') }}" class="btn btn-info float-right">Post
                            Photo</button>
                        <hr>
                        <form action="{{ url('/telegram/send-message') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" class="form-control" placeholder="Enter your query"
                                    rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label for="">Get Telegram ID</label>
                        <hr>
                        {{-- <form > --}}
                        <div class="form-group">
                            <label for="http_api_token">HTTP API Token</label>
                            <input type="text" class="form-control" id="http_api_token" name="http_api_token"
                                placeholder="Your BOT API Token Here. (XXX:YYYYYYY)">
                        </div>
                        <div class="form-group">
                            <label for="chatid">The Chat ID = </label>
                            <input type="text" id="chatid" readonly="true" class="form-control">
                            <textarea name="jsonresponse" id="jsonresponse" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button onclick="getChatID()" class="btn btn-primary float-right">Submit</button>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>

            <!-- End your project here-->
        </div><!-- /.card -->
    </div> <!-- /.col -->
    </div><!-- /.row -->
@endSection

@section('script')
    <script>
        function getChatID() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                        var myobj = JSON.parse(this.responseText)
                        //if 
                        try {
                            myobj.result.forEach((m) => {
                                //console.dir(m)
                                if (m.message && m.message.chat && m.message.chat.type && m.message.chat
                                    .type === "group") {
                                    document.getElementById("chatid").value = m.message.chat.id
                                }
                            })

                        } catch (e) {
                            console.log(e)
                        }
                        try {
                            document.getElementById("jsonresponse").innerHTML = JSON.stringify(myobj, undefined, 2)
                        } catch (e) {
                            console.log(e)
                        }
                    } else {
                        document.getElementById("jsonresponse").innerHTML = "Error, check your BOT HTTP API Token"
                    }
                    document.getElementById("jsonresponse").style = "animation:highlight-pre 1s"
                    setTimeout(() => {
                        document.getElementById("jsonresponse").style = "animation:none"
                    }, 1000)
                }
            };
            //console.log(document.getElementById("params").value)
            var api_token = document.getElementById("http_api_token").value
            var re = /[0-9]{9}:[a-zA-Z0-9_-]{35}/
            if (re.exec(api_token)) {
                xhttp.open("GET", "https://api.telegram.org/bot" + document.getElementById("http_api_token").value +
                    "/getUpdates", true)
                xhttp.setRequestHeader("Content-type", "application/json")
                xhttp.send()
            } else {
                document.getElementById("jsonresponse").innerHTML = "Error, check your BOT HTTP API Token"
            }
        }
    </script>
@endsection
