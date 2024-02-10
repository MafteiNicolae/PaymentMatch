<div class="modal fade" id="deleteGroupModal_{{$group->id}}" aria-labelledby="..." tabindex="-1" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Stergere grupul</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Sunteti sigur ca doriti sa stergeti acest grup?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Nu sterg</button>
                                                            <!-- Toogle to second dialog -->
                                                            <form method="GET" action="{{route('group.delete', ['group' => $group->id] )}}">@csrf
                                                                <button type="submit" class="btn btn-primary" data-bs-target="#secondmodal" data-bs-toggle="modal" data-bs-dismiss="modal">Sterge</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>