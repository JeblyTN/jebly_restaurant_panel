@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Paiements &amp; Gains</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Paiements &amp; Gains</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">

        {{-- Summary Cards --}}
        <div class="row" id="summary-cards">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Gains de la semaine</h5>
                        <h2 id="weekly-accrual">—</h2>
                        <p class="text-muted"><span id="weekly-order-count">—</span> commandes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Dernier virement</h5>
                        <h2 id="last-payout-amount">—</h2>
                        <p class="text-muted" id="last-payout-date">—</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-muted">Total des gains</h5>
                        <h2 id="total-earnings">—</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bank Details --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Coordonnées bancaires</h4>
                        <button class="btn btn-sm btn-outline-primary" id="toggle-bank-edit">Modifier</button>
                    </div>
                    <div class="card-body">
                        <div id="bank-display">
                            <p><strong>Banque :</strong> <span id="disp-bank-name">—</span></p>
                            <p><strong>RIB / Compte :</strong> <span id="disp-rib">—</span></p>
                            <p><strong>Titulaire :</strong> <span id="disp-holder">—</span></p>
                            <p><strong>Agence :</strong> <span id="disp-branch">—</span></p>
                        </div>
                        <form id="bank-form" style="display:none;">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Banque</label>
                                <div class="col-sm-9"><input type="text" class="form-control" id="bank-name" placeholder="Ex: STB, BNA, Attijari..."></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RIB / N° de compte</label>
                                <div class="col-sm-9"><input type="text" class="form-control" id="bank-rib"></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Titulaire du compte</label>
                                <div class="col-sm-9"><input type="text" class="form-control" id="bank-holder"></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Agence</label>
                                <div class="col-sm-9"><input type="text" class="form-control" id="bank-branch"></div>
                            </div>
                            <button type="button" class="btn btn-primary" id="save-bank">Enregistrer</button>
                            <button type="button" class="btn btn-secondary ml-2" id="cancel-bank-edit">Annuler</button>
                        </form>
                        <div id="bank-save-msg" class="alert alert-success mt-2" style="display:none;">Coordonnées bancaires enregistrées.</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payout History --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><h4 class="mb-0">Historique des virements</h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Commandes</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody id="payout-history-body">
                                    <tr><td colspan="4" class="text-center text-muted">Chargement…</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    const vendorUserId = '{{ $vendorUserId ?? '' }}';
    let vendorDocId = null;
    let currencySymbol = 'TND';

    if (!vendorUserId) {
        console.warn('No vendorUserId available');
        return;
    }

    // Load currency
    database.collection('currencies').where('isActive', '==', true).limit(1).get().then(snap => {
        if (!snap.empty) currencySymbol = snap.docs[0].data().symbol || 'TND';
    });

    // Resolve vendorID from users/{vendorUserId}
    database.collection('users').doc(vendorUserId).get().then(userDoc => {
        if (!userDoc.exists) return;
        vendorDocId = userDoc.data().vendorID || null;
        if (!vendorDocId) return;
        loadVendorData(vendorDocId);
        loadPayoutHistory(vendorDocId);
    });

    function fmt(amount) {
        return parseFloat(amount || 0).toFixed(2) + ' ' + currencySymbol;
    }

    function loadVendorData(vid) {
        database.collection('vendors').doc(vid).get().then(doc => {
            if (!doc.exists) return;
            const d = doc.data();

            document.getElementById('weekly-accrual').textContent = fmt(d.weeklyAccrual);
            document.getElementById('weekly-order-count').textContent = d.weeklyOrderCount || 0;

            const lastAmt = d.lastPayoutAmount;
            const lastAt  = d.lastPayoutAt;
            document.getElementById('last-payout-amount').textContent = lastAmt ? fmt(lastAmt) : 'Aucun';
            if (lastAt && lastAt.toDate) {
                document.getElementById('last-payout-date').textContent = lastAt.toDate().toLocaleDateString('fr-FR');
            }

            document.getElementById('total-earnings').textContent = fmt(d.totalEarnings);

            // Bank details
            const bank = d.userBankDetails || {};
            document.getElementById('disp-bank-name').textContent = bank.bankName || '—';
            document.getElementById('disp-rib').textContent        = bank.rib || '—';
            document.getElementById('disp-holder').textContent     = bank.accountHolder || '—';
            document.getElementById('disp-branch').textContent     = bank.branch || '—';
            document.getElementById('bank-name').value    = bank.bankName || '';
            document.getElementById('bank-rib').value     = bank.rib || '';
            document.getElementById('bank-holder').value  = bank.accountHolder || '';
            document.getElementById('bank-branch').value  = bank.branch || '';
        });
    }

    function loadPayoutHistory(vid) {
        database.collection('weeklyPayouts')
            .where('restaurantId', '==', vid)
            .orderBy('createdAt', 'desc')
            .limit(20)
            .get()
            .then(snap => {
                const tbody = document.getElementById('payout-history-body');
                if (snap.empty) {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Aucun virement</td></tr>';
                    return;
                }
                tbody.innerHTML = '';
                snap.forEach(d => {
                    const p = d.data();
                    const date = p.createdAt && p.createdAt.toDate
                        ? p.createdAt.toDate().toLocaleDateString('fr-FR') : '—';
                    const status = p.status || 'payé';
                    tbody.innerHTML += `<tr>
                        <td>${date}</td>
                        <td>${fmt(p.amount)}</td>
                        <td>${p.orderCount || '—'}</td>
                        <td><span class="badge badge-success">${status}</span></td>
                    </tr>`;
                });
            });
    }

    // Bank edit toggle
    document.getElementById('toggle-bank-edit').addEventListener('click', function () {
        document.getElementById('bank-display').style.display = 'none';
        document.getElementById('bank-form').style.display    = 'block';
        this.style.display = 'none';
    });
    document.getElementById('cancel-bank-edit').addEventListener('click', function () {
        document.getElementById('bank-display').style.display = 'block';
        document.getElementById('bank-form').style.display    = 'none';
        document.getElementById('toggle-bank-edit').style.display = '';
    });

    document.getElementById('save-bank').addEventListener('click', function () {
        if (!vendorDocId) return;
        const bankData = {
            bankName:      document.getElementById('bank-name').value.trim(),
            rib:           document.getElementById('bank-rib').value.trim(),
            accountHolder: document.getElementById('bank-holder').value.trim(),
            branch:        document.getElementById('bank-branch').value.trim(),
        };
        database.collection('vendors').doc(vendorDocId).set(
            { userBankDetails: bankData },
            { merge: true }
        ).then(() => {
            document.getElementById('disp-bank-name').textContent = bankData.bankName || '—';
            document.getElementById('disp-rib').textContent        = bankData.rib || '—';
            document.getElementById('disp-holder').textContent     = bankData.accountHolder || '—';
            document.getElementById('disp-branch').textContent     = bankData.branch || '—';
            document.getElementById('bank-display').style.display = 'block';
            document.getElementById('bank-form').style.display    = 'none';
            document.getElementById('toggle-bank-edit').style.display = '';
            const msg = document.getElementById('bank-save-msg');
            msg.style.display = 'block';
            setTimeout(() => msg.style.display = 'none', 3000);
        });
    });
})();
</script>
@endsection
