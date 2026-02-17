<form action="{{ route('teacher.exampaper.store', $exampaper->id) }}" id="createForm">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @forelse($questiontypes as $questiontype)
            <li role="presentation" class="{{ $loop->iteration == 1 ? 'active pl-2' : '' }} mr-2 border-right pr-2">
                <a href="#tab_el_{{ $questiontype->id }}" aria-controls="tab_el_{{ $questiontype->id }}" role="tab" data-toggle="tab">{{ $questiontype->name }}</a>
            </li>
        @empty
        @endforelse
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        @forelse($questiontypes as $questiontype)
            <div role="tabpanel" class="tab-pane {{ $loop->iteration == 1 ? 'active' : '' }}"
                id="tab_el_{{ $questiontype->id }}">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <span class="badge badge-info">{{ $questiontype->name }}</span>
                            {{ $questiontype->pivot->description }}
                        </div>
                        <div>
                            <strong>Total Marks</strong>: {{ $questiontype->pivot->total_marks }}
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $total_questions = $questiontype->pivot->total_questions;
                            $each_question_mark = $questiontype->pivot->total_marks / $questiontype->pivot->evaluated_question_nos;
                        @endphp

                        @for ($i = 1; $i <= $total_questions; $i++)
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="">Q{{ $i }}. <span class="badge badge-warning">Marks:
                                            {{ $each_question_mark }}</span></label>
                                    <textarea class="form-control" name="questions[{{ $questiontype->id }}][{{ $i }}][question]" id="" cols="30" rows="5"></textarea>
                                    <span class="text-danger error questions_{{ $questiontype->id }}_{{ $i }}_question_error"></span>
                                </div>
                            </div>
                            @if ($questiontype->will_have_ans_choice == 'Yes')
                                <label for="">Enter Options</label>
                                <div class="row mb-2">
                                    @for ($opt = 1; $opt <= 4; $opt++)
                                        <div class="col-md-6 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="radio"
                                                        name="questions[{{ $questiontype->id }}][{{ $i }}][correct_option]"
                                                        value="{{ $opt }}" aria-label="option_{{ $questiontype->id }}_{{ $i }}_{{ $opt }}">
                                                </span>

                                                <input type="text"
                                                    class="form-control"
                                                    name="questions[{{ $questiontype->id }}][{{ $i }}][options][{{ $opt }}]"
                                                    placeholder="Enter Option {{ $opt }}" aria-label="option_{{ $questiontype->id }}_{{ $i }}_1">
                                                
                                                <span class="text-danger error questions_{{ $questiontype->id }}_{{ $i }}_options_{{ $opt }}_error"></span>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>

    <button class="btn btn-success submitBtn">Save</button>
</form>
