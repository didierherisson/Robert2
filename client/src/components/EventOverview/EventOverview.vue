<template>
  <div class="EventOverview">
    <div class="EventOverview__header">
      <h1 class="EventOverview__title">{{ event.title }}</h1>
      <h2 class="EventOverview__dates-location">
        <i class="fas fa-map-marker-alt" />
        <span v-if="event.location">
          {{ $t('in') }} {{ event.location }},
        </span>
        {{ $t('from-date-to-date', fromToDates) }}
      </h2>
    </div>
    <p v-if="event.description" class="EventOverview__description">
      <i class="fas fa-clipboard" />
      {{ event.description }}
    </p>
    <div class="EventOverview__main">
      <section v-if="event.beneficiaries.length > 0" class="EventOverview__section">
        <dl class="EventOverview__info EventOverview__info--vertical">
          <dt class="EventOverview__info__term">
            <i class="fas fa-address-book" />
            {{ $t('page-events.event-beneficiaries') }}
          </dt>
          <dd class="EventOverview__info__value">
            <ul class="EventOverview__info__list">
              <li
                v-for="beneficiary in event.beneficiaries"
                :key="beneficiary.id"
                class="EventOverview__info__list-item"
              >
                <router-link
                  :to="`/beneficiaries/${beneficiary.id}`"
                  :title="$t('action-edit')"
                  tag="a"
                >
                  {{ beneficiary.full_name }}
                </router-link>
                <router-link
                  v-if="beneficiary.company"
                  :to="`/companies/${beneficiary.company_id}`"
                  :title="$t('action-edit')"
                  tag="a"
                >
                  ({{ beneficiary.company.legal_name }})
                </router-link>
              </li>
            </ul>
          </dd>
        </dl>
      </section>
      <section v-if="event.assignees.length > 0" class="EventOverview__section">
        <dl class="EventOverview__info EventOverview__info--vertical">
          <dt class="EventOverview__info__term">
            <i class="fas fa-people-carry" />
            {{ $t('page-events.event-technicians') }}
          </dt>
          <dd class="EventOverview__info__value">
            <ul class="EventOverview__info__list">
              <li
                v-for="technician in event.assignees"
                :key="technician.id"
                class="EventOverview__info__list-item"
              >
                <router-link
                  :key="technician.id"
                  :to="`/technicians/${technician.id}`"
                  tag="a"
                  class="EventOverview__info__link"
                  :title="$t('action-edit')"
                >
                  {{technician.full_name}}
                </router-link>
              </li>
            </ul>
          </dd>
        </dl>
      </section>
      <section class="EventOverview__section">
        <dl class="EventOverview__info">
          <dt class="EventOverview__info__term">
            <i class="far fa-clock" />
            {{ $t('duration') }}
          </dt>
          <dd class="EventOverview__info__value">
            {{ duration }} {{ $t('days') }}
          </dd>
        </dl>
      </section>
    </div>
    <div class="EventOverview__materials">
      <h3 class="EventOverview__materials__title">
        <i class="fas fa-box" />
        {{ $t('page-events.event-materials') }}
      </h3>
      <EventMaterials
        v-if="hasMaterials"
        :materials="event.materials"
        :start="startDate"
        :end="endDate"
        :withRentalPrices="showBilling && event.is_billable"
        :hideDetails="showBilling && event.is_billable"
      />
    </div>
    <h3 v-if="showBilling && event.is_billable" class="EventOverview__billing-title">
      <i class="fas fa-file-invoice-dollar" />
      {{ $t('billing') }}
    </h3>
    <div class="EventOverview__billing">
      <EventBilling
        v-if="hasMaterials && showBilling && event.is_billable"
        :beneficiaries="event.beneficiaries"
        :lastBill="lastBill"
        :materials="event.materials"
        :start="startDate"
        :end="endDate"
        :loading="billLoading"
        @discountRateChange="handleChangeDiscountRate"
        @createBill="handleCreateBill"
      />
      <EventTotals
        v-if="hasMaterials"
        :materials="event.materials"
        :withRentalPrices="showBilling && event.is_billable"
        :discountRate="discountRate"
        :start="startDate"
        :end="endDate"
      />
      <p v-if="!hasMaterials" class="EventOverview__materials__empty">
        <i class="fas fa-exclamation-triangle"></i>
        {{ $t('page-events.warning-no-material') }}
      </p>
    </div>
    <div class="EventOverview__missing-materials">
      <EventMissingMaterials :eventId="event.id" />
    </div>
  </div>
</template>

<style lang="scss">
  @import '../../themes/default/index';
  @import './EventOverview';
</style>

<script src="./index.js"></script>
