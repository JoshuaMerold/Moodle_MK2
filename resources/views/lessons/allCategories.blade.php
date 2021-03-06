@include('standards/head')


<body class="allCategories-body">
  @include('sidebar')
  @include('topbar')

  <!--TABS ab hier -->
  <div class="tab-body row col-md-12">

      <ul class=" nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="abstract-tab" data-toggle="tab" href="#abstract" role="tab" aria-controls="abstract" aria-selected="true">Zusammenfassungen ({{$fileZcount}})</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="old-test-tab" data-toggle="tab" href="#old-test" role="tab" aria-controls="old-test" aria-selected="false">Altklausuren ({{$fileAcount}})</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color: white;" id="index-cards-tab" data-toggle="tab" href="#index-cards" role="tab" aria-controls="index-cards" aria-selected="false">Karteikarten ({{$fileKcount}})</a>
        </li>
        <div class="button-div">
        <a href="/{{$currentLesson->id}}/add/File" class="button-add-file"></a>
        </div>

      </ul>
      <!-- Tab Zusammenfassungen -->
      <div class="tab-content col-md-12" id="myTabContent">
        <div class="tab-pane fade show active" id="abstract" role="tabpanel" aria-labelledby="abstract-tab">
          <table class="table table-striped table-sm" cellspacing="0" width="100%">
            <thead>
              <th class="th-sm">Typ</th>
              <th class="th-sm">Dateiname</th>
              <th class="th-sm">Dozent</th>
              <th class="th-sm">Jahrgang</th>
              <th class="th-sm">Datum</th>
              <th class="th-sm">Hochgeladen von</th>
              <th class="th-sm">Bewertung</th>
              <th class="th-sm">Action</th>
            </thead>
            @foreach($files as $file)
            @if($file->type == "zusammenfassung")
            <tbody>
              <td>{{$file->extension}}</td>
              <td><a href="/{{$currentLesson->id}}/{{$file->id}}/add/comment" class="file-name">{{$file->name}}</a></td>
              <td>{{$currentLesson->professorname}}</td>
              <td>
                @foreach($allUsers as $tempUser)
                  @if($file->creatoruserid == $tempUser->id)
                    {{$tempUser->coursename}}
                  @endif
                @endforeach
              </td>
              <td>{{ $file->created_at->format('d.m.Y') }}</td>
              <td>
                @foreach($creators as $creator)
                  @if($file->creatoruserid == $creator->id)
                    {{$creator->username}}
                  @endif
                @endforeach
              </td>
              <td>{{$file->voting}}</td>
              <td class="inner-table-align">
                <table class="inner-table">
                  <tr>
                    <td>
                      <a href="/download/{{$file->id}}" title="Download">
                        <img src="/assets/download.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    </td>
                    <td>
                      <a href="/{{$currentLesson->id}}/{{$file->id}}/add/comment" title="Kommentieren">
                        <img src="/assets/chat.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    </td>
                    <td>
                    @if($file->creatoruserid == $user->id)
                      <a href="/zusammenfassung/{{$currentLesson->id}}/{{$file->id}}/delete" title="Löschen">
                        <img src="/assets/delete.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    @endif
                    </td>
                  </tr>
                </table>
              </td>
            </tbody>
            @endif
            @endforeach
          </table>
        </div>
        <!-- Tab Altklausuren -->
        <div class="tab-pane fade" id="old-test" role="tabpanel" aria-labelledby="old-test-tab">
          <table class="table table-striped table-sm" cellspacing="0" width="100%">
            <thead>
              <th>Typ</th>
              <th>Dateiname</th>
              <th>Dozent</th>
              <th>Jahrgang</th>
              <th>Datum</th>
              <th>Hochgeladen von</th>
              <th>Bewertung</th>
              <th>Action</th>
            </thead>
            @foreach($files as $file)
            @if($file->type == "altklausur")
            <tbody>
              <td>{{$file->extension}}</td>
              <td><a href="/{{$currentLesson->id}}/{{$file->id}}/add/comment" class="file-name">{{$file->name}}</a></td>
              <td>{{$currentLesson->professorname}}</td>
              <td>
                @foreach($allUsers as $tempUser)
                  @if($file->creatoruserid == $tempUser->id)
                    {{$tempUser->coursename}}
                  @endif
                @endforeach
              </td>
              <td>{{ $file->created_at->format('d.m.Y') }}</td>
              <td>
                  @foreach($creators as $creator)
                    @if($file->creatoruserid == $creator->id)
                      {{$creator->username}}
                    @endif
                  @endforeach
              </td>
              <td>{{$file->voting}}</td>
              <td class="inner-table-align">
                <!-- {{Request::path()}} -->
                <table class="inner-table">
                  <tr>
                    <td>
                      <a href="/download/{{$file->id}}" title="Download">
                        <img src="/assets/download.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    </td>
                    <td>
                      <a href="/{{$currentLesson->id}}/{{$file->id}}/add/comment" title="Kommentieren">
                        <img src="/assets/chat.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    </td>
                    <td>
                    @if($file->creatoruserid == $user->id)
                      <a href="/zusammenfassung/{{$currentLesson->id}}/{{$file->id}}/delete" title="Löschen">
                        <img src="/assets/delete.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    @endif
                    </td>
                  </tr>
                </table>
              </td>
            </tbody>
            @endif
            @endforeach
          </table>
        </div>
        <!-- Tab Karteikarten -->
        <div class="tab-pane fade" id="index-cards" role="tabpanel" aria-labelledby="index-cards-tab">
          <table class="table table-striped table-sm" cellspacing="0" width="100%">
            <thead>
              <th>Typ</th>
              <th>Dateiname</th>
              <th>Dozent</th>
              <th>Jahrgang</th>
              <th>Datum</th>
              <th>Hochgeladen von</th>
              <th>Bewertung</th>
              <th>Action</th>
            </thead>
            @foreach($files as $file)
            @if($file->type == "karteikarte")
            <tbody>
              <td>{{$file->extension}}</td>
              <td><a href="/{{$currentLesson->id}}/{{$file->id}}/add/comment" class="file-name">{{$file->name}}</a></td>
              <td>{{$currentLesson->professorname}}</td>
              <td>
                @foreach($allUsers as $tempUser)
                  @if($file->creatoruserid == $tempUser->id)
                    {{$tempUser->coursename}}
                  @endif
                @endforeach
              </td>
              <td>{{ $file->created_at->format('d.m.Y') }}</td>
              <td>
                  @foreach($creators as $creator)
                    @if($file->creatoruserid == $creator->id)
                      {{$creator->username}}
                    @endif
                  @endforeach
              </td>
              <td>{{$file->voting}}</td>
              <td class="inner-table-align">
                <!-- {{Request::path()}} -->
                <table class="inner-table">
                  <tr>
                    <td>
                      <a href="/download/{{$file->id}}" title="Download">
                        <img src="/assets/download.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    </td>
                    <td>
                      <a href="/{{$currentLesson->id}}/{{$file->id}}/add/comment" title="Kommentieren">
                        <img src="/assets/chat.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    </td>
                    <td>
                    @if($file->creatoruserid == $user->id)
                      <a href="/zusammenfassung/{{$currentLesson->id}}/{{$file->id}}/delete" title="Löschen">
                        <img src="/assets/delete.svg" style="height: 15px; vertical-align: baseline;"/>
                      </a>
                    @endif
                    </td>
                  </tr>
                </table>
              </td>
            </tbody>
            @endif
            @endforeach
          </table>
        </div>
      </div>
  </div>
</body>
