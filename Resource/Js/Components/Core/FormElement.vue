<template>
  <div>

    <!-- TEXT -->
    <div v-if="type=='text'" class="form-floating">
      <input type="text" class="form-control" :id="key" placeholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- DATE -->
    <div v-if="type=='date'" class="form-floating">
      <input type="date" class="form-control" :id="key" placeholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- TIME -->
    <div v-if="type=='time'" class="form-floating">
      <input type="time" class="form-control" :id="key" placeholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- EMAIL -->
    <div v-if="type=='email'" class="form-floating">
      <input type="email" class="form-control" :id="key" placeholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- PASSWORD -->
    <div v-if="type=='password'" class="form-floating">
      <input type="password" class="form-control" :id="key" placeholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
      <label :for="key">{{ label }}</label>
    </div>

    <!-- TEXTAREA -->
    <div v-if="type=='textarea'" class="form-floating">
      <textarea class="form-control" placeholder="Leave a comment here" :id="key" style="height: 120px;" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"></textarea>
      <label :for="key">{{ label }}</label>
    </div>

    <!-- COLOR -->
    <div v-if="type=='color'" class="input-group">
      <input type="color" class="form-control form-control-color" :id="key" placeholder="" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
      <label class="input-group-text" :for="key">{{ label }}</label>
    </div>

    <!-- IMAGE -->
    <div v-if="type=='image'" class="input-group">
      <input type="file" class="form-control" :id="key" @input="$emit('update:modelValue', $event.target.files[0])">
      <label class="input-group-text" :for="key">{{ label }}</label>
    </div>

    <!-- FILE -->
    <div v-if="type=='file'" class="input-group">
      <input type="file" class="form-control" :id="key" @input="$emit('update:modelValue', $event.target.files[0])">
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

  props: ['type','label','key','val','options', 'modelValue'],

  data: function(){
    return {
    };
  },

  methods: {},

}
</script>