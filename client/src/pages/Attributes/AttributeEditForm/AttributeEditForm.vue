<template>
  <div class="AttributeEditForm">
    <div class="AttributeEditForm__name">
      <input
        ref="InputName"
        type="text"
        class="AttributeEditForm__input"
        :placeholder="$t('page-attributes.name')"
      />
      <div v-if="errors.name" class="AttributeEditForm__error" style="word-break: break-all;">
        {{ errors.name[0] }}
      </div>
    </div>
    <div class="AttributeEditForm__type">
      <select
        ref="InputType"
        class="AttributeEditForm__select"
        @change="handleTypeChange"
      >
        <option value="string">{{ $t('page-attributes.type-string') }}</option>
        <option value="integer">{{ $t('page-attributes.type-integer') }}</option>
        <option value="float">{{ $t('page-attributes.type-float') }}</option>
        <option value="boolean">{{ $t('page-attributes.type-boolean') }}</option>
      </select>
      <ul v-if="errors.type" class="AttributeEditForm__error">
        <li v-for="typeError in errors.type" :key="typeError">
          {{ typeError }}
        </li>
      </ul>
    </div>
    <div class="AttributeEditForm__unit">
      <input
        ref="InputUnit"
        v-if="hasUnit"
        type="text"
        class="AttributeEditForm__input"
        :placeholder="$t('page-attributes.unit')"
      />
      <div v-if="errors.unit" class="AttributeEditForm__error">
        {{ errors.unit[0] }}
      </div>
    </div>
    <div class="AttributeEditForm__max-length">
      <input
        ref="InputMaxLength"
        v-if="hasMaxLength"
        type="number"
        class="AttributeEditForm__input"
        :placeholder="$t('page-attributes.max-length')"
      />
      <div v-if="errors.max_length" class="AttributeEditForm__error">
        {{ errors.max_length[0] }}
      </div>
    </div>
  </div>
</template>

<style lang="scss">
  @import '../../../themes/default/index';
  @import './AttributeEditForm';
</style>

<script src="./index.js"></script>
