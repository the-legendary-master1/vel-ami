<div id="profile_field_modal" class="modal fade my-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update @{{ fieldType }}</h4>
            </div>

            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Type here . . ." v-model="profileFieldData.f_name" v-if="fieldType == 'First Name'">
                <input type="text" class="form-control" placeholder="Type here . . ." v-model="profileFieldData.m_name" v-if="fieldType == 'Middle Name'">
                <input type="text" class="form-control" placeholder="Type here . . ." v-model="profileFieldData.l_name" v-if="fieldType == 'Last Name'">
                <input type="email" class="form-control" placeholder="Type here . . ." v-model="profileFieldData.email" v-if="fieldType == 'Email Address'">
                <input type="Password" class="form-control" placeholder="Type here . . ." v-model="profileFieldData.secret" v-if="fieldType == 'Password'">
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" @click="submitProfileField()">Submit</button>
            </div>
        </div>
    </div>
</div>