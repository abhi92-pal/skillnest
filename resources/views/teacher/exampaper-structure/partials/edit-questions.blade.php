<form method="POST" action="{{ route('teacher.exampaper.update', $exampaper->id) }}" id="createForm">
    @csrf

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @foreach($exampaper->questiontypes as $questiontype)
            <li role="presentation"
                class="{{ $loop->first ? 'active pl-2' : '' }} mr-2 border-right pr-2">
                <a href="#tab_el_{{ $questiontype->id }}"
                   aria-controls="tab_el_{{ $questiontype->id }}"
                   role="tab"
                   data-toggle="tab">
                    {{ $questiontype->name }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">

        @foreach($exampaper->questiontypes as $questiontype)

            @php
                $sectionQuestions = $exampaper->questions
                    ->where('questiontype_id', $questiontype->id)
                    ->values();

                $eachMark = $questiontype->pivot->total_marks  / $questiontype->pivot->evaluated_question_nos;
            @endphp

            <div role="tabpanel"
                 class="tab-pane {{ $loop->first ? 'active' : '' }}"
                 id="tab_el_{{ $questiontype->id }}">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <span class="badge badge-info">
                                {{ $questiontype->name }}
                            </span>
                            {{ $questiontype->pivot->description }}
                        </div>

                        <div>
                            <strong>Total Marks:</strong>
                            {{ $questiontype->pivot->total_marks }}
                        </div>
                    </div>

                    <div class="card-body">

                        @foreach($sectionQuestions as $index => $question)

                            <div class="row mb-3">
                                <div class="col-md-12 form-group">
                                    <label>
                                        Q{{ $index + 1 }}
                                        <span class="badge badge-warning">
                                            Marks: {{ $eachMark }}
                                        </span>
                                    </label>

                                    <textarea class="form-control"
                                        name="questions[{{ $questiontype->id }}][{{ $index + 1 }}][question]"
                                        rows="4">{{ $question->question }}</textarea>
                                    <span class="text-danger error questions_{{ $questiontype->id }}_{{ $index + 1 }}_question_error"></span>
                                </div>
                            </div>

                            {{-- Options --}}
                            @if($questiontype->will_have_ans_choice == 'Yes')

                                <label>Options</label>

                                <div class="row mb-3">
                                    @foreach($question->questionoptions as $optIndex => $option)

                                        <div class="col-md-6 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="radio"
                                                        name="questions[{{ $questiontype->id }}][{{ $index + 1 }}][correct_option]"
                                                        value="{{ $optIndex + 1 }}"
                                                        {{ $option->is_correct == 'Yes' ? 'checked' : '' }}>
                                                </span>

                                                <input type="text"
                                                    class="form-control"
                                                    name="questions[{{ $questiontype->id }}][{{ $index + 1 }}][options][{{ $optIndex + 1 }}]"
                                                    value="{{ $option->option }}">
                                                <span class="text-danger error questions_{{ $questiontype->id }}_{{ $index + 1 }}_options_{{ $optIndex }}_error"></span>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>

                            @endif

                        @endforeach

                    </div>
                </div>
            </div>

        @endforeach
    </div>
    @if($exampaper->is_question_freezed == 'No')
        <button type="submit" class="btn btn-success mt-3 submitBtn">
            Update
        </button>
    @endif
</form>
