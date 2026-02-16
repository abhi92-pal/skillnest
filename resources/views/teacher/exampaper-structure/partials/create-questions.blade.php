@forelse($questiontypes as $questiontype)
    <div role="tabpanel" class="tab-pane {{ $loop->iteration == 1 ? 'active' : '' }}" id="tab_el_{{ $questiontype->id }}">
        <div class="card">
            <div class="card-header">
                <div>
                    <span class="badge badge-info">{{ $questiontype->name }}</span> {{ $questiontype->pivot->description }}
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
                
                @for($i = 1; $i <= $total_questions; $i++)
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Q{{ $i }}. <span class="badge badge-warning">Marks: {{ $each_question_mark }}</span></label>
                            <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    @if($questiontype->will_have_ans_choice == 'Yes')
                        <label for="">Enter Options</label>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input type="radio" aria-label="option_{{ $questiontype->id }}_{{ $i }}_1">
                                    </span>
                                    <input type="text" class="form-control" aria-label="option_{{ $questiontype->id }}_{{ $i }}_1" placeholder="Enter Option">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input type="radio" aria-label="option_{{ $questiontype->id }}_{{ $i }}_2">
                                    </span>
                                    <input type="text" class="form-control" aria-label="option_{{ $questiontype->id }}_{{ $i }}_2" placeholder="Enter Option">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input type="radio" aria-label="option_{{ $questiontype->id }}_{{ $i }}_3">
                                    </span>
                                    <input type="text" class="form-control" aria-label="option_{{ $questiontype->id }}_{{ $i }}_3" placeholder="Enter Option">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input type="radio" aria-label="option_{{ $questiontype->id }}_{{ $i }}_4">
                                    </span>
                                    <input type="text" class="form-control" aria-label="option_{{ $questiontype->id }}_{{ $i }}_4" placeholder="Enter Option">
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
@empty
@endforelse