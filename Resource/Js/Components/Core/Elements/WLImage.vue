<template>
    <div :class="classes">
        <img :src="src" :alt="alt">
    </div>
</template>

<script>
export default {
    props: ['src', 'classes', 'alt'],
}
</script>