<template>
    <h3 :class="headerclasses">
        {{ headertext }}
    </h3>
</template>

<script>
export default {
    props: ['headertext', 'headerclasses'],
}
</script>