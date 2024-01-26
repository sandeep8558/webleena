<template>
    <h6 :class="headerclasses">
        {{ headertext }}
    </h6>
</template>

<script>
export default {
    props: ['headertext', 'headerclasses'],
}
</script>