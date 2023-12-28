<template>
  <div>

    <!-- TEXT -->
    <div v-if="type=='text'" class="form-floating">
      <input type="text" class="form-control" :id="key" placeholder="" v-model="elmVal">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- DATE -->
    <div v-if="type=='date'" class="form-floating">
      <input type="date" class="form-control" :id="key" placeholder="" v-model="elmVal">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- TIME -->
    <div v-if="type=='time'" class="form-floating">
      <input type="time" class="form-control" :id="key" placeholder="" v-model="elmVal">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- EMAIL -->
    <div v-if="type=='email'" class="form-floating">
      <input type="email" class="form-control" :id="key" placeholder="" v-model="elmVal">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- PASSWORD -->
    <div v-if="type=='password'" class="form-floating">
      <input type="password" class="form-control" :id="key" placeholder="" v-model="elmVal">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- TEXTAREA -->
    <div v-if="type=='textarea'" class="form-floating">
      <textarea class="form-control" placeholder="Leave a comment here" :id="key" style="height: 120px;" v-model="elmVal"></textarea>
      <label :for="key">{{ label }}</label>
    </div>

    <!-- COLOR -->
    <div v-if="type=='color'" class="input-group">
      <input type="color" class="form-control form-control-color" :id="key" placeholder="" v-model="elmVal">
      <label class="input-group-text" :for="key">{{ label }}</label>
    </div>

    <!-- FILE -->
    <div v-if="type=='file'" class="input-group">
      <input type="file" class="form-control" :id="key">
      <label class="input-group-text" :for="key">{{ label }}</label>
    </div>

    <!-- SELECT -->
    <div v-if="type=='select'" class="form-floating">
      <select class="form-select" :id="key" aria-label="Floating label select example">
        <option selected>Open this select menu</option>
      </select>
      <label :for="key">{{ label }}</label>
    </div>

  </div>
</template>

<script>
export default {

  props: ['type','label','key','val','options'],

  data: function(){
    return {
      elmVal: this.val ? this.val : '',
    };
  },

  methods: {},

}
</script>