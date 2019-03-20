<template>
  <div class="card">
      <div class="card-header">
        <i class="fas fa-pencil-alt"></i> Edit Profile
      </div>
      <div class="card-body">
        <form class="form-horizontal">
          <div class="form-group row">
            <label class="col-md-3">User Name</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.name}" type="text" v-model="user.name">
              <span class="help-block">Enter your username, so people you know can recognize you.</span>
              <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Email</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.email}" type="email" v-model="user.email">
              <span class="help-block">This email will be displayed on your public profile.</span>
              <div class="invalid-feedback" v-if="errors.email">{{errors.email[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">First Name</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.firstname}" type="text" v-model="user.firstname">
              <span class="help-block">Enter your first name, so people you know can recognize you.</span>
              <div class="invalid-feedback" v-if="errors.firstname">{{errors.firstname[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Last Name</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.lastname}" type="text" v-model="user.lastname">
              <span class="help-block">Enter your last name, so people you know can recognize you.</span>
              <div class="invalid-feedback" v-if="errors.lastname">{{errors.lastname[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Phone</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.phone}" type="text" v-model="user.phone">
              <span class="help-block">Enter your phone number associated with the account.</span>
              <div class="invalid-feedback" v-if="errors.phone">{{errors.phone[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Height</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.height}" type="text" v-model="user.height">
              <span class="help-block">Your height in inches.</span>
              <div class="invalid-feedback" v-if="errors.height">{{errors.height[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Weight</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.weight}" type="text" v-model="user.weight">
              <span class="help-block">Your weight in pounds.</span>
              <div class="invalid-feedback" v-if="errors.weight">{{errors.weight[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Gender</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.gender}" type="text" v-model="user.gender">
              <span class="help-block">Enter genger.</span>
              <div class="invalid-feedback" v-if="errors.gender">{{errors.gender[0]}}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3">Birthdate</label>
            <div class="col-md-9">
              <input class="form-control" :class="{'is-invalid': errors.birthdate}" type="text" v-model="user.birthdate">
              <span class="help-block">Date of birth in YYYY-MM-DD format.</span>
              <div class="invalid-feedback" v-if="errors.birthdate">{{errors.birthdate[0]}}</div>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="form-group row">
          <div class="col-md-9 offset-md-3">
            <button class="btn btn-primary" type="button" :disabled="submiting" @click="updateAuthUser" >
              <i class="fas fa-spinner fa-spin" v-if="submiting"></i> Save
            </button>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      user: {},
      errors: {},
      submiting: false
    }
  },
  mounted() {
    this.getAuthUser()
  },
  methods: {
    getAuthUser () {
      axios.get(`/api/profile/getAuthUser`)
      .then(response => {
        this.user = response.data
      })
    },
    updateAuthUser () {
      this.submiting = true
      axios.put(`/api/profile/updateAuthUser`, this.user)
      .then(response => {
        this.errors = {}
        this.submiting = false
        this.$toasted.global.error('Profile updated!');
      })
      .catch(error => {
        this.errors = error.response.data.errors
        this.submiting = false
      })
    }
  }
}
</script>