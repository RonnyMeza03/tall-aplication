<div class="w-full h-min space-y-4">
    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <x-stat title="Total de Ofertas" :icon="'icons.briefcase-bussines'" :count="$totalJobOffers" />
        <x-stat title="Total de usuarios en las ofertas" :icon="'icons.user'" :count="$totalJobOffersUsers" />
        <x-stat title="Total de ofertas que estan por expirar esta semana" :icon="'icons.calendar-days'" :count="$totalJobOffersByExpiredThisWeek" />
    </div>
    
    <x-barchart :barchartData="$barchartData" />
    <x-oferts-by-expired-at />
</div>