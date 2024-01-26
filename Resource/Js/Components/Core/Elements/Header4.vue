<template>
    <h4 :class="headerclasses">
        {{ headertext }}
    </h4>
</template>

<script>
export default {
    props: ['headertext', 'headerclasses'],
}
</script>