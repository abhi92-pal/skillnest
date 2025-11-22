@forelse($semesters as $semester)
    <div class="card">
        <div class="card-header p-0" id="heading_sem_{{ $loop->iteration }}">
            <input type="hidden" name="t_sem[]" value="{{ $semester->id }}">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse_sem_{{ $loop->iteration }}" aria-expanded="true"
                    aria-controls="collapse_sem_{{ $loop->iteration }}">
                    {{ $semester->name }}
                </button>
            </h2>
        </div>

        <div id="collapse_sem_{{ $loop->iteration }}" class="collapse show"
            aria-labelledby="heading_sem_{{ $loop->iteration }}" data-parent="#semesterTopicAccordion">
            <div class="card-body sem_topic_wrap">
                <div class="sem_topic_body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Topic Details</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="t_name_{{ $semester->id }}_0">Topic Name <span class="text-danger">&#42;</span></label>
                                <input id="t_name_{{ $semester->id }}_0" class="form-control" name="t_name[{{ $semester->id }}][0]" type="text">
                                <span class="text-danger error t_name_{{ $semester->id }}_0_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="t_author_{{ $semester->id }}_0">Author <span class="text-danger">&#42;</span></label>
                                <select id="t_author_{{ $semester->id }}_0" name="t_author[{{ $semester->id }}][0]" class="form-control">
                                    <option value="">Select Author</option>
                                    @forelse($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <span class="text-danger error t_author_{{ $semester->id }}_0_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="t_description_{{ $semester->id }}_0">Description <span class="text-danger">&#42;</span></label>
                                <textarea id="t_description_{{ $semester->id }}_0" class="form-control" name="t_description[{{ $semester->id }}][0]" placeholder="Enter Description"></textarea>
                                <span class="text-danger error t_description_{{ $semester->id }}_0_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success add_more" data-last_iteration="0" data-semid="{{ $semester->id }}">+ Add More</button>
            </div>
        </div>
    </div>
@empty
    <div class="text-center">No semester found</div>
@endforelse
