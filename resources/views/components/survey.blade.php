    <div class="card" id="survey-div">
        <button class="close-survey"><i class="material-icons">close</i></button>
        <div class="card-body">
            <h5 class="card-title text-center">Give us Feedback</h5>
            <p class="comment-text">Feel free to minimize the survey if you are not ready to respond.</p>
            <p class="card-text">How would you rate Martineez</p>

            <form id="form-survey">
                {{csrf_field()}}
                <input type="hidden" name="surId" value="{{$survey[0]->survey_id}}">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">3</th>
                    <th scope="col">4</th>
                    <th scope="col">5</th>
                </tr>
                </thead>
                <tbody>
                @php($j=1)
                @foreach($survey as $item)

                    <tr>
                        <th scope="row">{{$item->question}}</th>
                        <input type="hidden" name="quesId{{$j}}" value="{{$item->id}}">
                        @for($i=1;$i<=5;$i++)
                            <td><input type="radio" name="rbQuestion{{$j}}" value="{{$i}}"/></td>
                            @endfor
                    </tr>
                    @php($j++)
                    @endforeach
                </tbody>
            </table>

                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                <progress  class="progress mb-2" style="width: 100%" value="0" max="100">
                </progress>

                <div id="error-survey">
                </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-sm">Rate</button>
            </div>
            </form>
        </div>
    </div>