<template>
    <a :class="classes" :href="link">
        {{ buttontext }}
    </a>
</template>

<script>
export default {
    props: ['buttontext', 'classes', 'link'],
}
</script>