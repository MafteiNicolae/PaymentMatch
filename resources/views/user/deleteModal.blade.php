<!-- <div class="modal bs-example-modal" id="deleteUserModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stergere utilizator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->



<div class="modal fade" id="deleteUserModal_{{$user->id}}" aria-labelledby="..." tabindex="-1" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Stergere utilizator</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Sunteti sigur ca doriti sa stergeti acest utilizator?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Nu sterg</button>
                                                            <!-- Toogle to second dialog -->
                                                            <form method="POST" action="{{route('users.delete', ['user' => $user] )}}">@csrf
                                                                <button type="submit" class="btn btn-primary" data-bs-target="#secondmodal" data-bs-toggle="modal" data-bs-dismiss="modal">Sterge</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>